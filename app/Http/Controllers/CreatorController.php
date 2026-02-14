<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CreatorController extends Controller
{
    public function register(Request $request): View
    {
        return view('creator.create', [
            'creators' => Creator::query()->latest()->take(20)->get(),
            'activeCreator' => $this->activeCreator($request),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'display_name' => ['required', 'string', 'max:100'],
            'bio' => ['nullable', 'string', 'max:1500'],
            'telegramusername' => ['nullable', 'string', 'max:100'],
            'telegramid' => ['nullable', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:120'],
            'social_platforms' => ['nullable', 'string', 'max:500'],
            'niches' => ['nullable', 'string', 'max:500'],
        ]);

        $creator = Creator::create([
            'display_name' => $validated['display_name'],
            'bio' => $validated['bio'] ?? null,
            'telegramusername' => $validated['telegramusername'] ?? null,
            'telegramid' => $validated['telegramid'] ?? null,
            'location' => $validated['location'] ?? null,
            'social_platforms' => $this->splitList($validated['social_platforms'] ?? null),
            'niches' => $this->splitList($validated['niches'] ?? null),
        ]);

        $request->session()->put('creator_id', $creator->id);

        return redirect()
            ->route('creator.profile', $creator)
            ->with('status', 'Creator profile created and set as active.');
    }

    public function switch(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'creator_id' => ['required', 'integer', 'exists:creators,id'],
        ]);

        $request->session()->put('creator_id', (int) $validated['creator_id']);

        return redirect()
            ->back()
            ->with('status', 'Active creator profile changed.');
    }

    public function profile(Request $request, Creator $creator): View
    {
        $creator->loadCount('applications');

        return view('creator.profile', [
            'creator' => $creator,
            'activeCreator' => $this->activeCreator($request),
        ]);
    }

    public function applications(Request $request): RedirectResponse|View
    {
        $creator = $this->activeCreator($request);

        if ($creator === null) {
            return redirect()
                ->route('creator.register')
                ->with('error', 'Register or switch to a creator profile first.');
        }

        $applications = $creator->applications()
            ->with('campaign.promoter')
            ->latest()
            ->paginate(20);

        return view('creator.applications', [
            'creator' => $creator,
            'applications' => $applications,
        ]);
    }

    private function activeCreator(Request $request): ?Creator
    {
        $creatorId = $request->session()->get('creator_id');

        if ($creatorId === null) {
            return null;
        }

        return Creator::find($creatorId);
    }

    private function splitList(?string $value): array
    {
        if ($value === null || trim($value) === '') {
            return [];
        }

        return collect(explode(',', $value))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }
}
