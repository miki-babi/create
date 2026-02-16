@extends('layouts.app')

@section('title', 'My Applications')

@section('content')
    @php
        $statusClass = [
            'pending' => 'chip',
            'shortlisted' => 'chip chip-brand',
            'accepted' => 'chip chip-brand',
            'rejected' => 'chip',
        ];
    @endphp

    <section class="surface p-5 md:p-6 reveal">
        <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
            <div>
                <p class="chip chip-brand mb-2">Creator desk</p>
                <h1 class="headline text-3xl font-extrabold">My Applications</h1>
                <p class="muted mt-1 text-sm">Tracking: {{ $creator->display_name }}</p>
            </div>
            <a href="{{ route('campaigns.index') }}" class="btn-secondary text-sm">Browse campaigns</a>
        </div>

        <div class="space-y-3 stagger">
            @forelse ($applications as $application)
                <article class="surface-strong p-4">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <p class="headline text-xl font-bold">
                                <a href="{{ route('campaigns.show', $application->campaign) }}" class="hover:underline">
                                    {{ $application->campaign->title }}
                                </a>
                            </p>
                            <p class="muted mt-1 text-sm">
                                {{ $application->campaign->promoter->company_name ?? 'Unknown promoter' }}
                                <span class="mx-1">/</span>
                                Applied {{ $application->created_at->format('M d, Y') }}
                            </p>
                        </div>
                        <span class="{{ $statusClass[$application->status] ?? 'chip' }}">{{ ucfirst($application->status) }}</span>
                    </div>

                    <div class="mt-3 rounded-2xl border border-slate-200 bg-slate-50/70 p-3">
                        <p class="text-sm leading-relaxed text-slate-700 whitespace-pre-line">{{ $application->pitch }}</p>
                    </div>

                    @if (!empty($application->links))
                        <div class="mt-3">
                            <p class="label">Submitted links</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($application->links as $link)
                                    <a href="{{ $link }}" target="_blank" class="chip hover:underline">{{ $link }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </article>
            @empty
                <div class="surface-strong p-8 text-center">
                    <h3 class="headline text-xl font-bold">No applications yet</h3>
                    <p class="muted mt-1 text-sm">Apply to campaigns to start building your track record.</p>
                </div>
            @endforelse
        </div>
    </section>

    <div class="mt-6 reveal">
        {{ $applications->links() }}
    </div>
@endsection
