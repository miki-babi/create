@extends('layouts.app')

@section('title', 'My Campaigns')

@section('content')
    <section class="surface p-5 md:p-6 reveal">
        <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
            <div>
                <p class="chip chip-brand mb-2">Promoter dashboard</p>
                <h1 class="headline text-3xl font-extrabold">My Campaigns</h1>
                <p class="muted mt-1 text-sm">Active promoter: {{ $promoter->company_name }}</p>
            </div>
            <a href="{{ route('campaigns.create') }}" class="btn-primary text-sm">Post new campaign</a>
        </div>

        <div class="space-y-3 stagger">
            @forelse ($campaigns as $campaign)
                <article class="surface-strong p-4">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <p class="headline text-xl font-bold">
                                <a href="{{ route('campaigns.show', $campaign) }}" class="hover:underline">{{ $campaign->title }}</a>
                            </p>
                            <p class="muted mt-1 text-sm">
                                {{ $campaign->created_at->diffForHumans() }}
                                <span class="mx-1">/</span>
                                {{ $campaign->applications_count }} applications
                            </p>
                        </div>

                        <p class="headline text-2xl font-extrabold text-slate-900">
                            {{ $campaign->budget !== null ? '$' . number_format($campaign->budget, 2) : 'TBD' }}
                        </p>
                    </div>

                    <div class="mt-3 flex flex-wrap gap-2">
                        @if ($campaign->niche)
                            <span class="chip">#{{ $campaign->niche }}</span>
                        @endif
                        @foreach (($campaign->platforms ?? []) as $platform)
                            <span class="chip">#{{ $platform }}</span>
                        @endforeach
                    </div>

                    <div class="mt-4 flex flex-wrap gap-2">
                        <a href="{{ route('campaigns.show', $campaign) }}" class="btn-secondary text-sm">Edit</a>
                        <a href="{{ route('campaigns.applicants', $campaign) }}" class="btn-primary text-sm">Applicants</a>
                    </div>
                </article>
            @empty
                <article class="surface-strong p-8 text-center">
                    <h3 class="headline text-xl font-extrabold">No campaigns yet</h3>
                    <p class="muted mt-1 text-sm">Create your first campaign to start receiving creator applications.</p>
                </article>
            @endforelse
        </div>
    </section>

    <div class="mt-6 reveal">
        {{ $campaigns->links() }}
    </div>
@endsection
