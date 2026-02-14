@extends('layouts.app')

@section('title', 'Post Campaign')

@section('content')
    <section class="surface mx-auto max-w-4xl p-5 md:p-6 reveal">
        <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="chip chip-brand mb-2">Promoter workspace</p>
                <h1 class="headline text-3xl font-extrabold">Post New Campaign</h1>
                <p class="muted mt-1 text-sm">Describe your brief clearly to attract stronger creator applications.</p>
            </div>
            <a href="{{ route('promoter.campaigns') }}" class="btn-secondary text-sm">Back to my campaigns</a>
        </div>

        <form action="{{ route('campaigns.store') }}" method="POST" class="grid grid-cols-1 gap-4 md:grid-cols-2">
            @csrf

            <div class="md:col-span-2">
                <label class="label" for="title">Campaign title</label>
                <input id="title" type="text" name="title" value="{{ old('title') }}" required class="field"
                    placeholder="Example: UGC launch for mobile finance app">
            </div>

            <div class="md:col-span-2">
                <label class="label" for="description">Campaign description</label>
                <textarea id="description" name="description" class="textarea" rows="7"
                    placeholder="Share deliverables, creative direction, audience fit, and expected timeline.">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="label" for="platforms">Platforms</label>
                <input id="platforms" type="text" name="platforms" value="{{ old('platforms') }}" class="field"
                    placeholder="youtube,tiktok,instagram">
                <p class="muted mt-1 text-xs">Comma-separated</p>
            </div>

            <div>
                <label class="label" for="niche">Niche</label>
                <input id="niche" type="text" name="niche" value="{{ old('niche') }}" class="field"
                    placeholder="tech, beauty, gaming">
            </div>

            <div>
                <label class="label" for="budget">Budget (USD)</label>
                <input id="budget" type="number" step="0.01" min="0" name="budget" value="{{ old('budget') }}" class="field"
                    placeholder="1500.00">
            </div>

            <div>
                <label class="label" for="timeline">Target date</label>
                <input id="timeline" type="date" name="timeline" value="{{ old('timeline') }}" class="field">
            </div>

            <div class="md:col-span-2 mt-1 flex flex-wrap gap-2">
                <button type="submit" class="btn-primary text-sm">Post campaign</button>
                <a href="{{ route('promoter.campaigns') }}" class="btn-secondary text-sm">Cancel</a>
            </div>
        </form>
    </section>
@endsection
