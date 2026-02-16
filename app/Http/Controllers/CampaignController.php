<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignApplication;
use App\Models\Creator;
use App\Models\Promoter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CampaignController extends Controller
{
    public function index(Request $request): View
    {
        $filters = [
            'q' => trim((string) $request->input('q', '')),
            'niche' => trim((string) $request->input('niche', '')),
            'platform' => trim((string) $request->input('platform', '')),
        ];

        $campaigns = Campaign::query()
            ->with('promoter')
            ->withCount('applications')
            ->when($filters['q'] !== '', function ($query) use ($filters) {
                $query->where(function ($nestedQuery) use ($filters) {
                    $nestedQuery
                        ->where('title', 'like', '%' . $filters['q'] . '%')
                        ->orWhere('description', 'like', '%' . $filters['q'] . '%');
                });
            })
            ->when($filters['niche'] !== '', function ($query) use ($filters) {
                $query->where('niche', 'like', '%' . $filters['niche'] . '%');
            })
            ->when($filters['platform'] !== '', function ($query) use ($filters) {
                $query->whereJsonContains('platforms', $filters['platform']);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('job.index', [
            'campaigns' => $campaigns,
            'filters' => $filters,
        ]);
    }

    public function show(Request $request, Campaign $campaign): View
    {
        $campaign->load(['promoter', 'applications.creator']);

        if (!Auth::check()) {
            abort(403);
        }
        // $userId = (int) Auth::id();
        $userId = (int) Auth::id();

        Log::info('Showing campaign', [
            'campaign_id' => $campaign->id,
            'promoter_id' => $campaign->promoter_id,
            'auth_user_id' => $userId
        ]);

        $promoterId = (int) $campaign->promoter_id;

        $role = $userId === $promoterId ? 'promoter' : 'creator';

        Log::info('Determined user role for campaign view', [
            'role' => $role,
        ]);

        return view('job.show', [
            'campaign' => $campaign,
            'role' => $role,
            'alreadyApplied' => $campaign->applications->contains('creator_id', $userId),
        ]);
    }

    public function create(Request $request): View|RedirectResponse
    {
        $role = Auth::user()->role;


        if ($role !== "promoter") {
            return redirect()
                ->route('promoter.register')
                ->with('error', 'Register or switch to a promoter profile to post campaigns.');
        }

        return view('job.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $promoter = Auth::user();

        if ($promoter === null) {
            return redirect()
                ->route('promoter.register')
                ->with('error', 'Register or switch to a promoter profile to post campaigns.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'description' => ['nullable', 'string'],
            'platforms' => ['nullable', 'string', 'max:255'],
            'niche' => ['nullable', 'string', 'max:80'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'timeline' => ['nullable', 'date'],
        ]);

        $campaign = Campaign::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'platforms' => $this->splitList($validated['platforms'] ?? null),
            'niche' => $validated['niche'] ?? null,
            'budget' => $validated['budget'] ?? null,
            'timeline' => $validated['timeline'] ?? null,
            'promoter_id' => $promoter->id,
        ]);

        return redirect()
            ->route('campaigns.show', $campaign)
            ->with('status', 'Campaign posted successfully.');
    }

    public function edit(Request $request, Campaign $campaign): View
    {
        // $this->authorizePromoterCampaignAccess($request, $campaign);
        $promoter = Auth::user();
        Log::info('Editing campaign', [
            'campaign_id' => $campaign->id,
            'promoter_id' => $campaign->promoter_id,
            'auth_user_id' => $promoter ? $promoter->id : null
        ]);
        if ($promoter === null || $campaign->promoter_id !== $promoter->id) {
            abort(403);
        }

        return view('job.edit', [
            'campaign' => $campaign,
        ]);
    }

    public function update(Request $request, Campaign $campaign): RedirectResponse
    {
        $this->authorizePromoterCampaignAccess($request, $campaign);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'description' => ['nullable', 'string'],
            'platforms' => ['nullable', 'string', 'max:255'],
            'niche' => ['nullable', 'string', 'max:80'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'timeline' => ['nullable', 'date'],
        ]);

        $campaign->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'platforms' => $this->splitList($validated['platforms'] ?? null),
            'niche' => $validated['niche'] ?? null,
            'budget' => $validated['budget'] ?? null,
            'timeline' => $validated['timeline'] ?? null,
        ]);

        return redirect()
            ->route('campaigns.show', $campaign)
            ->with('status', 'Campaign updated successfully.');
    }

    public function apply(Request $request, Campaign $campaign): View|RedirectResponse
    {
        $creator = $this->activeCreator($request);

        if ($creator === null) {
            return redirect()
                ->route('creator.register')
                ->with('error', 'Register or switch to a creator profile to apply.');
        }

        $alreadyApplied = CampaignApplication::query()
            ->where('campaign_id', $campaign->id)
            ->where('creator_id', $creator->id)
            ->exists();

        if ($alreadyApplied) {
            return redirect()
                ->route('creator.applications')
                ->with('status', 'You already applied to this campaign.');
        }

        return view('job.application', [
            'campaign' => $campaign->load('promoter'),
        ]);
    }

    public function storeApplication(Request $request, Campaign $campaign): RedirectResponse
    {
        $creator = $this->activeCreator($request);

        if ($creator === null) {
            return redirect()
                ->route('creator.register')
                ->with('error', 'Register or switch to a creator profile to apply.');
        }

        $alreadyApplied = CampaignApplication::query()
            ->where('campaign_id', $campaign->id)
            ->where('creator_id', $creator->id)
            ->exists();

        if ($alreadyApplied) {
            return redirect()
                ->route('creator.applications')
                ->with('status', 'You already applied to this campaign.');
        }

        $validated = $request->validate([
            'pitch' => ['required', 'string', 'min:30'],
            'links' => ['nullable', 'string', 'max:1000'],
        ]);

        $campaign->applications()->create([
            'creator_id' => $creator->id,
            'pitch' => $validated['pitch'],
            'links' => $this->splitLines($validated['links'] ?? null),
            'status' => 'pending',
        ]);

        return redirect()
            ->route('creator.applications')
            ->with('status', 'Application submitted successfully.');
    }

    public function applicants(Request $request, Campaign $campaign): View
    {
        $this->authorizePromoterCampaignAccess($request, $campaign);

        $status = trim((string) $request->input('status', ''));

        $applications = $campaign->applications()
            ->with('creator')
            ->when($status !== '', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('job.applicants', [
            'campaign' => $campaign,
            'applications' => $applications,
            'selectedStatus' => $status,
        ]);
    }

    public function updateApplicationStatus(
        Request $request,
        Campaign $campaign,
        CampaignApplication $application,
    ): RedirectResponse {
        $this->authorizePromoterCampaignAccess($request, $campaign);

        if ($application->campaign_id !== $campaign->id) {
            abort(404);
        }

        $validated = $request->validate([
            'status' => ['required', 'in:pending,shortlisted,accepted,rejected'],
        ]);

        $application->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('campaigns.applicants', $campaign)
            ->with('status', 'Application status updated.');
    }

    private function authorizePromoterCampaignAccess(Request $request, Campaign $campaign): void
    {
        $promoter = $this->activePromoter($request);

        if ($promoter === null || $campaign->promoter_id !== $promoter->id) {
            abort(403);
        }
    }

    private function activeCreator(Request $request): ?Creator
    {
        $creatorId = $request->session()->get('creator_id');

        if ($creatorId === null) {
            return null;
        }

        return Creator::find($creatorId);
    }

    private function activePromoter(Request $request): ?Promoter
    {
        $promoterId = $request->session()->get('promoter_id');

        if ($promoterId === null) {
            return null;
        }

        return Promoter::find($promoterId);
    }

    private function splitList(?string $value): array
    {
        if ($value === null || trim($value) === '') {
            return [];
        }

        return collect(explode(',', $value))
            ->map(fn($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }

    private function splitLines(?string $value): array
    {
        if ($value === null || trim($value) === '') {
            return [];
        }

        return collect(preg_split('/\r\n|\r|\n/', $value))
            ->map(fn($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }
}
