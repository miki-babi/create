@extends('layouts.app')

@section('title', 'Discovery Feed')

@section('content')
    <section class="mb-6 reveal">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="headline text-5xl font-extrabold text-slate-900 md:text-6xl">Discovery Feed</h1>
                <p class="muted mt-2 text-lg">Explore the best brand opportunities for your niche.</p>
            </div>

            <div class="flex items-center gap-2">
                @if ($isPromoter ?? false)
                    <a href="{{ route('campaigns.create') }}" class="btn-secondary text-sm">Post new</a>
                @endif
                <button type="button" class="btn-secondary text-sm">Filters</button>
                <a href="#filters" class="btn-primary text-sm">Search</a>
            </div>
        </div>
    </section>

    {{-- <section id="filters" class="surface mb-5 p-4 md:p-5 reveal">
        <form action="{{ route('campaigns.index') }}" method="GET" class="grid grid-cols-1 gap-3 md:grid-cols-4 md:items-end">
            <div>
                <label class="label" for="q">Search</label>
                <input id="q" type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="field"
                    placeholder="Campaign title or description">
            </div>

            <div>
                <label class="label" for="niche">Niche</label>
                <input id="niche" type="text" name="niche" value="{{ $filters['niche'] ?? '' }}" class="field"
                    placeholder="Tech, Gaming...">
            </div>

            <div>
                <label class="label" for="platform">Platform</label>
                <input id="platform" type="text" name="platform" value="{{ $filters['platform'] ?? '' }}" class="field"
                    placeholder="YouTube, TikTok...">
            </div>

            <div>
                <button type="submit" class="btn-primary w-full text-sm">Search</button>
            </div>
        </form>
    </section> --}}

    <section class="space-y-4 stagger">
        @forelse ($campaigns as $campaign)
            @php
                $status = 'open';
                $statusClass = 'status-open';
                $buttonClass = 'btn-primary';
                $buttonText = 'View Details';

                if ($campaign->timeline && $campaign->timeline->isPast()) {
                    $status = 'closed';
                    $statusClass = 'status-closed';
                    $buttonClass = 'btn-secondary';
                    $buttonText = 'Filled';
                } elseif ($campaign->timeline && now()->diffInDays($campaign->timeline, false) <= 7) {
                    $status = 'urgent';
                    $statusClass = 'status-urgent';
                }
            @endphp

            <article class="surface-strong rounded-[1.6rem] p-5 md:p-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="flex min-w-0 items-start gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-slate-200 bg-slate-100 text-sm font-extrabold text-slate-500">
                            {{ strtoupper(substr($campaign->promoter->company_name ?? 'B', 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <h2 class="headline truncate text-3xl font-extrabold text-slate-900 md:text-4xl">
                                {{ $campaign->title }}
                            </h2>
                            <p class="muted mt-1 text-sm">
                                {{ $campaign->promoter->company_name ?? 'Unknown promoter' }}
                                <span class="mx-1">•</span>
                                {{ $campaign->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    <span class="status-badge {{ $statusClass }}">{{ $status }}</span>
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    @if ($campaign->niche)
                        <span class="chip">#{{ $campaign->niche }}</span>
                    @endif
                    @foreach (($campaign->platforms ?? []) as $platform)
                        <span class="chip">#{{ $platform }}</span>
                    @endforeach
                </div>

                <div class="mt-5 h-px bg-slate-200"></div>

                <div class="mt-4 flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Est. budget</p>
                        <p class="headline mt-1 text-3xl font-extrabold text-slate-900 md:text-4xl">
                            @if ($campaign->budget !== null)
                                ${{ number_format($campaign->budget, 2) }}
                            @else
                                TBD
                            @endif
                        </p>
                    </div>

                    <a href="{{ route('campaigns.show', $campaign) }}" class="{{ $buttonClass }} min-w-[10rem] text-sm">{{ $buttonText }}</a>
                </div>
            </article>
        @empty
            <article class="surface-strong p-10 text-center">
                <h3 class="headline text-3xl font-extrabold">No opportunities yet</h3>
                <p class="muted mt-2 text-sm">Try clearing filters or post your first campaign.</p>
            </article>
        @endforelse
    </section>

    <div class="mt-8 reveal">
        {{ $campaigns->links() }}
    </div>
@endsection
