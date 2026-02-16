@extends('layouts.app')

@section('title', $creator->display_name)

@section('content')
    <section class="surface mx-auto max-w-5xl p-5 md:p-6 reveal">
        <div class="flex flex-wrap items-start justify-between gap-3">
            <div>
                <p class="chip chip-brand mb-2">Creator profile</p>
                <h1 class="headline text-3xl font-extrabold">{{ $creator->display_name }}</h1>
                <p class="muted mt-1 text-sm">
                    {{ $creator->telegramusername ? '@' . $creator->telegramusername : 'No Telegram username' }}
                    @if ($creator->location)
                        <span class="mx-1">/</span>{{ $creator->location }}
                    @endif
                </p>
            </div>

            <div class="surface-strong px-4 py-3 text-center">
                <p class="muted text-xs uppercase tracking-wide">Applications</p>
                <p class="headline text-2xl font-extrabold">{{ $creator->applications_count }}</p>
            </div>
        </div>

        <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-2">
            <article class="surface-strong p-4">
                <p class="label">Bio</p>
                <p class="text-sm leading-relaxed text-slate-700 whitespace-pre-line">{{ $creator->bio ?: 'No bio provided.' }}</p>
            </article>

            <article class="surface-strong p-4">
                <p class="label">Telegram ID</p>
                <p class="text-sm text-slate-700">{{ $creator->telegramid ?: 'Not provided' }}</p>
            </article>

            <article class="surface-strong p-4">
                <p class="label">Social platforms</p>
                @if (!empty($creator->social_platforms))
                    <div class="flex flex-wrap gap-2">
                        @foreach ($creator->social_platforms as $platform)
                            <span class="chip">{{ $platform }}</span>
                        @endforeach
                    </div>
                @else
                    <p class="muted text-sm">No social platforms set.</p>
                @endif
            </article>

            <article class="surface-strong p-4">
                <p class="label">Niches</p>
                @if (!empty($creator->niches))
                    <div class="flex flex-wrap gap-2">
                        @foreach ($creator->niches as $niche)
                            <span class="chip chip-brand">{{ $niche }}</span>
                        @endforeach
                    </div>
                @else
                    <p class="muted text-sm">No niches set.</p>
                @endif
            </article>
        </div>

        <div class="mt-5 flex flex-wrap gap-2">
            <a href="{{ route('campaigns.index') }}" class="btn-primary text-sm">Browse campaigns</a>
            <a href="{{ route('creator.applications') }}" class="btn-secondary text-sm">My applications</a>
        </div>
    </section>
@endsection
