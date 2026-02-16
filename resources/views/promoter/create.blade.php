@extends('promoter.layouts.app')

@section('title', 'Promoter Setup')

@section('content')
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 reveal">
        <section class="surface p-5 md:p-6">
            <p class="chip chip-brand mb-2">Promoter onboarding</p>
            <h1 class="headline text-3xl font-extrabold">Create Promoter Profile</h1>
            <p class="muted mt-1 text-sm">Set your brand identity before posting jobs and reviewing applicants.</p>

            <form action="{{ route('promoter.store') }}" method="POST" class="mt-5 space-y-4">
                @csrf

                <div>
                    <label class="label" for="company_name">Company name</label>
                    <input id="company_name" type="text" name="company_name" value="{{ old('company_name') }}" required
                        class="field" placeholder="NextGen Gear Co.">
                </div>

                <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                    <div>
                        <label class="label" for="telegramusername">Telegram username</label>
                        <input id="telegramusername" type="text" name="telegramusername" value="{{ old('telegramusername') }}"
                            class="field" placeholder="nextgengcar">
                    </div>

                    <div>
                        <label class="label" for="telegramid">Telegram ID</label>
                        <input id="telegramid" type="text" name="telegramid" value="{{ old('telegramid') }}" class="field"
                            placeholder="123456789">
                    </div>
                </div>

                <div>
                    <label class="label" for="company_description">Company description</label>
                    <textarea id="company_description" name="company_description" rows="6" class="textarea"
                        placeholder="Brief summary of your brand, campaigns, and target creators">{{ old('company_description') }}</textarea>
                </div>

                <button type="submit" class="btn-primary text-sm">Create and activate</button>
            </form>
        </section>

        <section class="surface-strong p-5 md:p-6">
            <p class="chip mb-2">Profile switcher</p>
            <h2 class="headline text-2xl font-extrabold">Switch Active Promoter</h2>
            <p class="muted mt-1 text-sm">Current: {{ $activePromoter?->company_name ?? 'none' }}</p>

            @if ($promoters->isEmpty())
                <div class="mt-4 meta-card">No promoter profiles yet.</div>
            @else
                <form action="{{ route('promoter.switch') }}" method="POST" class="mt-4 flex flex-col gap-3">
                    @csrf
                    <select name="promoter_id" class="select">
                        @foreach ($promoters as $promoter)
                            <option value="{{ $promoter->id }}" @selected((int) session('promoter_id') === $promoter->id)>
                                {{ $promoter->company_name }}
                                {{ $promoter->telegramusername ? '(@' . $promoter->telegramusername . ')' : '' }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-secondary w-fit text-sm">Set active</button>
                </form>

                <div class="mt-4 space-y-2">
                    @foreach ($promoters as $promoter)
                        <article class="rounded-2xl border border-slate-200 bg-white/80 p-3 text-sm">
                            <a href="{{ route('promoter.profile', $promoter) }}" class="font-extrabold hover:underline">
                                {{ $promoter->company_name }}
                            </a>
                            <p class="muted mt-1">{{ $promoter->telegramusername ? '@' . $promoter->telegramusername : 'No telegram username' }}</p>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
@endsection
