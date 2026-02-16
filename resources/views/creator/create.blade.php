@extends('promoter.layouts.app')

@section('title', 'Creator Setup')

@section('content')
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 reveal">
        <section class="surface p-5 md:p-6">
            <p class="chip chip-brand mb-2">Creator onboarding</p>
            <h1 class="headline text-3xl font-extrabold">Create Creator Profile</h1>
            <p class="muted mt-1 text-sm">Set your identity and strengths so promoters can evaluate your fit quickly.</p>

            <form action="{{ route('creator.store') }}" method="POST" class="mt-5 space-y-4">
                @csrf

                <div>
                    <label class="label" for="display_name">Display name</label>
                    <input id="display_name" type="text" name="display_name" value="{{ old('display_name') }}" required
                        class="field" placeholder="Alex Rivers">
                </div>

                <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                    <div>
                        <label class="label" for="telegramusername">Telegram username</label>
                        <input id="telegramusername" type="text" name="telegramusername" value="{{ old('telegramusername') }}"
                            class="field" placeholder="alexrivers">
                    </div>

                    <div>
                        <label class="label" for="telegramid">Telegram ID</label>
                        <input id="telegramid" type="text" name="telegramid" value="{{ old('telegramid') }}"
                            class="field" placeholder="123456789">
                    </div>
                </div>

                <div>
                    <label class="label" for="location">Location</label>
                    <input id="location" type="text" name="location" value="{{ old('location') }}" class="field"
                        placeholder="Dubai, UAE">
                </div>

                <div>
                    <label class="label" for="bio">Bio</label>
                    <textarea id="bio" name="bio" rows="5" class="textarea"
                        placeholder="Short positioning statement and audience style">{{ old('bio') }}</textarea>
                </div>

                <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                    <div>
                        <label class="label" for="social_platforms">Social platforms</label>
                        <input id="social_platforms" type="text" name="social_platforms" value="{{ old('social_platforms') }}"
                            class="field" placeholder="youtube:120k,instagram:44k">
                    </div>

                    <div>
                        <label class="label" for="niches">Niches</label>
                        <input id="niches" type="text" name="niches" value="{{ old('niches') }}" class="field"
                            placeholder="tech,education">
                    </div>
                </div>

                <button type="submit" class="btn-primary text-sm">Create and activate</button>
            </form>
        </section>

        <section class="surface-strong p-5 md:p-6">
            <p class="chip mb-2">Profile switcher</p>
            <h2 class="headline text-2xl font-extrabold">Switch Active Creator</h2>
            <p class="muted mt-1 text-sm">Current: {{ $activeCreator?->display_name ?? 'none' }}</p>

            @if ($creators->isEmpty())
                <div class="mt-4 meta-card">No creator profiles yet.</div>
            @else
                <form action="{{ route('creator.switch') }}" method="POST" class="mt-4 flex flex-col gap-3">
                    @csrf
                    <select name="creator_id" class="select">
                        @foreach ($creators as $creator)
                            <option value="{{ $creator->id }}" @selected((int) session('creator_id') === $creator->id)>
                                {{ $creator->display_name }}
                                {{ $creator->telegramusername ? '(@' . $creator->telegramusername . ')' : '' }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-secondary w-fit text-sm">Set active</button>
                </form>

                <div class="mt-4 space-y-2">
                    @foreach ($creators as $creator)
                        <article class="rounded-2xl border border-slate-200 bg-white/80 p-3 text-sm">
                            <a href="{{ route('creator.profile', $creator) }}" class="font-extrabold hover:underline">
                                {{ $creator->display_name }}
                            </a>
                            <p class="muted mt-1">{{ $creator->location ?: 'No location set' }}</p>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
@endsection
