@extends('layouts.app')

@section('title', 'Edit Campaign')

@section('content')
    <section class="surface mx-auto max-w-4xl p-5 md:p-6 reveal">
        <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="chip mb-2">Owner access</p>
                <h1 class="headline text-3xl font-extrabold">Edit Campaign</h1>
                <p class="muted mt-1 text-sm">Refine scope, budget, and targeting to improve application quality.</p>
            </div>
            <a href="{{ route('campaigns.show', $campaign) }}" class="btn-secondary text-sm">Back to campaign</a>
        </div>

        <form action="{{ route('campaigns.update', $campaign) }}" method="POST" class="grid grid-cols-1 gap-4 md:grid-cols-2">
            @csrf
            @method('PUT')

            <div class="md:col-span-2">
                <label class="label" for="title">Campaign title</label>
                <input id="title" type="text" name="title" value="{{ old('title', $campaign->title) }}" required
                    class="field">
            </div>

            <div class="md:col-span-2">
                <label class="label" for="description">Campaign description</label>
                <textarea id="description" name="description" rows="7" class="textarea">{{ old('description', $campaign->description) }}</textarea>
            </div>

            <div>
                <label class="label" for="platforms">Platforms</label>
                <input id="platforms" type="text" name="platforms"
                    value="{{ old('platforms', implode(',', $campaign->platforms ?? [])) }}" class="field">
            </div>

            <div>
                <label class="label" for="niche">Niche</label>
                <input id="niche" type="text" name="niche" value="{{ old('niche', $campaign->niche) }}" class="field">
            </div>

            <div>
                <label class="label" for="budget">Budget (USD)</label>
                <input id="budget" type="number" step="0.01" min="0" name="budget"
                    value="{{ old('budget', $campaign->budget) }}" class="field">
            </div>

            <div>
                <label class="label" for="timeline">Target date</label>
                <input id="timeline" type="date" name="timeline"
                    value="{{ old('timeline', $campaign->timeline?->format('Y-m-d')) }}" class="field">
            </div>

            <div class="md:col-span-2 mt-1 flex flex-wrap gap-2">
                <button type="submit" class="btn-primary text-sm">Save changes</button>
                <a href="{{ route('campaigns.show', $campaign) }}" class="btn-secondary text-sm">Cancel</a>
            </div>
        </form>
    </section>
@endsection
