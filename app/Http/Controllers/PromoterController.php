<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Promoter;
use App\Services\TelegramService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PromoterController extends Controller
{
    public function register(Request $request): View
    {
        return view('promoter.create', [
            'promoters' => Promoter::query()->latest()->take(20)->get(),
            'activePromoter' => $this->activePromoter($request),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:150'],
            'telegramusername' => ['nullable', 'string', 'max:100'],
            'telegramid' => ['nullable', 'string', 'max:100'],
            'company_description' => ['nullable', 'string', 'max:1500'],
        ]);

        $promoter = Promoter::create([
            'company_name' => $validated['company_name'],
            'telegramusername' => $validated['telegramusername'] ?? null,
            'telegramid' => $validated['telegramid'] ?? null,
            'company_description' => $validated['company_description'] ?? null,
            'is_verified' => false,
        ]);

        $request->session()->put('promoter_id', $promoter->id);

        return redirect()
            ->route('promoter.profile', $promoter)
            ->with('status', 'Promoter profile created and set as active.');
    }

    public function switch(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'promoter_id' => ['required', 'integer', 'exists:promoters,id'],
        ]);

        $request->session()->put('promoter_id', (int) $validated['promoter_id']);

        return redirect()
            ->back()
            ->with('status', 'Active promoter profile changed.');
    }

    public function profile(Request $request, Promoter $promoter): View
    {
        $promoter->loadCount('campaigns');

        return view('promoter.profile', [
            'promoter' => $promoter,
            'activePromoter' => $this->activePromoter($request),
        ]);
    }

    public function campaigns(Request $request): RedirectResponse|View
    {
        $active = Auth::user()->telegramid ;

        $promoter = Promoter::where('telegramid', $active)->first();
        Log::info('Active promoter Telegram ID:', ['telegramid' => $promoter]);

        if ($promoter === null) {
            return redirect()
                ->route('promoter.register')
                ->with('error', 'Register or switch to a promoter profile first.');
        }

            $campaigns = Campaign::where('promoter_id', $promoter->id)
                ->withCount('applications')
                ->latest()
                ->paginate(20);
        // $campaigns = $promoter->campaigns()
        //     ->withCount('applications')
        //     ->latest()
        //     ->paginate(20);

        return view('promoter.jobs', [
            'promoter' => $promoter,
            'campaigns' => $campaigns,
        ]);
    }

    private function activePromoter(Request $request): ?Promoter
    {
        $promoterId = $request->session()->get('promoter_id');

        if ($promoterId === null) {
            return null;
        }

        return Promoter::find($promoterId);
    }

    public function handleWebhook(Request $request)
    {
        $payload = $request->all();

        // Log the payload for debugging
        Log::info('Received Promoter Webhook:', $payload);

        $chatId = $payload['message']['chat']['id'];

        if (($payload['message']['text'] ?? '') === '/start') {
        $telegramService = new TelegramService();
        $telegramService->sendMiniAppButton($chatId);
        }

   

        // $promoter=Promoter::firstOrCreate(
        //     ['telegramid' => $chatId],
        //     [
        //         // 'company_name' => 'Telegram User ' . $chatId,
        //         'telegramusername' => $payload['message']['chat']['username'] ?? null,
        //         // 'company_description' => 'Registered via Telegram Webhoo',
        //         'is_verified' => false,
        //     ]
        // );

        // if ($promoter) {
        //     Log::info("Promoter record created or found for Telegram ID: {$chatId}");
        // } else {
        //     Log::error("Failed to create or find promoter for Telegram ID: {$chatId}");
        // }
        



        // Process the webhook data as needed
        // For example, you might want to update promoter information based on the payload
        return response()->json(['status' => 'ok']);
    }
}
