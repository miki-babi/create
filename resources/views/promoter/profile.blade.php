@extends('layouts.app')

@section('title', $promoter->company_name)

@section('content')
    <section class="surface mx-auto max-w-5xl p-5 md:p-6 reveal">
        <div class="flex flex-wrap items-start justify-between gap-3">
            <div>
                <p class="chip chip-brand mb-2">Promoter profile</p>
                <h1 class="headline text-3xl font-extrabold">{{ $promoter->company_name }}</h1>
                <p class="muted mt-1 text-sm">
                    {{ $promoter->telegramusername ? '@' . $promoter->telegramusername : 'No Telegram username' }}
                </p>
            </div>

            <div class="surface-strong px-4 py-3 text-center">
                <p class="muted text-xs uppercase tracking-wide">Campaigns</p>
                <p class="headline text-2xl font-extrabold">{{ $promoter->campaigns_count }}</p>
            </div>
        </div>

        <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-2">
            <article class="surface-strong p-4">
                <p class="label">Company description</p>
                <p class="text-sm leading-relaxed text-slate-700 whitespace-pre-line">{{ $promoter->company_description ?: 'No description provided.' }}</p>
            </article>

            <article class="surface-strong p-4">
                <p class="label">Telegram ID</p>
                <p class="text-sm text-slate-700">{{ $promoter->telegramid ?: 'Not provided' }}</p>
            </article>
        </div>

        <div class="mt-5 flex flex-wrap gap-2">
            <a href="{{ route('campaigns.create') }}" class="btn-primary text-sm">Post campaign</a>
            <a href="{{ route('promoter.campaigns') }}" class="btn-secondary text-sm">My campaigns</a>
        </div>
    </section>
@endsection
