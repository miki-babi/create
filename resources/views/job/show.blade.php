@extends('layouts.app')

@section('title', $campaign->title)

@section('content')
    <div class="grid grid-cols-1 gap-4  reveal">
        <section class="surface p-5 md:p-6">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <p class="chip chip-brand mb-2">Open campaign</p>
                    <h1 class="headline text-3xl font-extrabold">{{ $campaign->title }}</h1>
                    <p class="muted mt-2 text-sm">Posted by
                        {{ $campaign->promoter->company_name ?? 'Unknown promoter' }}</br> Created:
                        {{ $campaign->created_at->format('M d, Y') }}</p>
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
                @foreach ($campaign->platforms ?? [] as $platform)
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

      <section class="fixed bottom-0 left-0 w-full bg-white/90 backdrop-blur-lg border-t border-slate-200 px-4 pt-3 pb-8 z-50">
    <div class="max-w-5xl mx-auto">
        
        {{-- CREATOR VIEW: High-Focus Single CTA --}}
        @if ($role === 'creator')
            <div class="w-full">
                @if ($alreadyApplied)
                    <a href="{{ route('creator.applications') }}" 
                       class="btn-secondary flex w-full items-center justify-center py-3.5 text-sm font-bold tracking-tight">
                        View my application
                    </a>
                @else
                    <a href="{{ route('applications.create', $campaign) }}" 
                       class="btn-primary flex w-full items-center justify-center py-3.5 text-sm font-bold tracking-tight shadow-lg shadow-blue-500/20">
                        Apply to campaign
                    </a>
                @endif
            </div>
        @endif

        {{-- PROMOTER VIEW: Split Action Layout --}}
        @if ($role === 'promoter')
            <div class="flex items-center gap-3">
                <a href="{{ route('campaigns.edit', $campaign) }}" 
                   class="flex-1 flex items-center justify-center py-3.5 px-2 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-xs font-bold uppercase tracking-wider">
                    Edit
                </a>

                <a href="{{ route('campaigns.applicants', $campaign) }}" 
                   class="flex-[2.5] flex items-center justify-center gap-2 py-3.5 px-4 rounded-xl bg-slate-900 text-white text-sm font-bold shadow-xl shadow-slate-900/10">
                    <span>Review Applicants</span>
                    <span class="inline-flex items-center justify-center bg-blue-500 text-white text-[10px] h-5 min-w-[20px] px-1.5 rounded-full font-black">
                        {{ $campaign->applications->count() }}
                    </span>
                </a>
            </div>
        @endif

    </div>
</section>
    </div>
@endsection
