@extends('layouts.app')

@section('title', $campaign->title)

@section('content')
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-[1.35fr_0.85fr] reveal">
        <section class="surface p-5 md:p-6">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <p class="chip chip-brand mb-2">Open campaign</p>
                    <h1 class="headline text-3xl font-extrabold">{{ $campaign->title }}</h1>
                    <p class="muted mt-2 text-sm">Posted by {{ $campaign->promoter->company_name ?? 'Unknown promoter' }}</p>
                </div>
                <div class="surface-strong min-w-[12rem] p-3 text-sm">
                    <p class="font-semibold">Budget</p>
                    <p class="headline mt-1 text-2xl font-extrabold">
                        ${{ $campaign->budget !== null ? number_format($campaign->budget, 2) : 'TBD' }}
                    </p>
                    <p class="muted mt-1">Deadline: {{ $campaign->timeline?->format('M d, Y') ?? 'Flexible' }}</p>
                </div>
            </div>

            <div class="mt-4 flex flex-wrap gap-2">
                @if ($campaign->niche)
                    <span class="chip chip-brand">{{ $campaign->niche }}</span>
                @endif
                @foreach (($campaign->platforms ?? []) as $platform)
                    <span class="chip">{{ $platform }}</span>
                @endforeach
            </div>

            <div class="mt-6 rounded-2xl border border-slate-200 bg-white/70 p-4">
                <h2 class="headline text-lg font-bold">Campaign brief</h2>
                <p class="mt-2 text-sm leading-relaxed text-slate-700 whitespace-pre-line">
                    {{ $campaign->description ?: 'No description provided.' }}
                </p>
            </div>
        </section>

        <aside class="surface-strong p-5">
            <h2 class="headline text-xl font-bold">Actions</h2>

            <div class="mt-4 flex flex-col gap-2">
                @if ($role === 'creator' && $alreadyApplied)
                    <a href="{{ route('creator.applications') }}" class="btn-primary text-center text-sm">View my application</a>
                @elseif ($role === 'creator' && !$alreadyApplied)
                    <a href="{{ route('applications.create', $campaign) }}" class="btn-primary text-center text-sm">Apply to campaign</a>
                @endif

                @if ($role === 'promoter')
                    <a href="{{ route('campaigns.edit', $campaign) }}" class="btn-primary text-center text-sm">Edit campaign</a>
                    <a href="{{ route('campaigns.applicants', $campaign) }}" class="btn-secondary text-center text-sm">Review applicants</a>
                @endif
            </div>

            <div class="mt-5 border-t border-slate-200 pt-4">
                <p class="label">Quick facts</p>
                <div class="grid grid-cols-1 gap-2 text-sm">
                    <div class="meta-card">Applications: {{ $campaign->applications->count() }}</div>
                    <div class="meta-card">Created: {{ $campaign->created_at->format('M d, Y') }}</div>
                </div>
            </div>
        </aside>
    </div>
@endsection
