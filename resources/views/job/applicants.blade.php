@extends('layouts.app')

@section('title', 'Applicants')

@section('content')
    @php
        $statusOptions = ['pending', 'shortlisted', 'accepted', 'rejected'];
        $statusBadge = [
            'pending' => 'chip',
            'shortlisted' => 'chip chip-brand',
            'accepted' => 'chip chip-brand',
            'rejected' => 'chip',
        ];
    @endphp

    <section class="surface p-5 md:p-6 reveal">
        <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
            <div>
                <p class="chip chip-brand mb-2">Applicant review</p>
                <h1 class="headline text-3xl font-extrabold">{{ $campaign->title }}</h1>
                <p class="muted mt-1 text-sm">Review creators, adjust status, and manage shortlist quality.</p>
            </div>
            <a href="{{ route('campaigns.show', $campaign) }}" class="btn-secondary text-sm">Back to campaign</a>
        </div>

        <form method="GET" action="{{ route('campaigns.applicants', $campaign) }}"
            class="surface-strong mb-4 flex flex-wrap items-end gap-2 p-3">
            <div class="min-w-[14rem]">
                <label class="label" for="status">Filter status</label>
                <select id="status" name="status" class="select">
                    <option value="">All statuses</option>
                    @foreach ($statusOptions as $status)
                        <option value="{{ $status }}" @selected($selectedStatus === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn-primary text-sm">Apply filter</button>
        </form>

        <div class="space-y-3 stagger">
            @forelse ($applications as $application)
                <article class="surface-strong p-4">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <p class="headline text-xl font-bold">{{ $application->creator->display_name ?? 'Unknown creator' }}</p>
                            <p class="muted mt-1 text-sm">
                                {{ $application->creator->telegramusername ? '@' . $application->creator->telegramusername : 'no telegram username' }}
                                <span class="mx-1">/</span>
                                applied {{ $application->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <div class="flex flex-col items-end gap-2">
                            <span class="{{ $statusBadge[$application->status] ?? 'chip' }}">{{ ucfirst($application->status) }}</span>
                            <form method="POST" action="{{ route('campaigns.applications.status', [$campaign, $application]) }}"
                                class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="select min-w-[9rem] py-2">
                                    @foreach ($statusOptions as $status)
                                        <option value="{{ $status }}" @selected($application->status === $status)>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn-primary text-sm">Save</button>
                            </form>
                        </div>
                    </div>

                    <div class="mt-4 rounded-2xl border border-slate-200 bg-slate-50/70 p-3">
                        <p class="text-sm leading-relaxed text-slate-700 whitespace-pre-line">{{ $application->pitch }}</p>
                    </div>

                    @if (!empty($application->links))
                        <div class="mt-3">
                            <p class="label">Links</p>
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
                    <p class="muted mt-1 text-sm">Share your campaign to start receiving creator submissions.</p>
                </div>
            @endforelse
        </div>
    </section>

    <div class="mt-6 reveal">
        {{ $applications->links() }}
    </div>
@endsection
