@extends('promoter.layouts.app')

@section('title', 'Apply to Campaign')

@section('content')
    <section class="surface mx-auto max-w-3xl p-5 md:p-6 reveal">
        <div class="mb-5">
            <p class="chip chip-brand mb-2">Creator submission</p>
            <h1 class="headline text-3xl font-extrabold">Apply to {{ $campaign->title }}</h1>
            <p class="muted mt-2 text-sm">
                {{ $campaign->promoter->company_name ?? 'Unknown promoter' }}
                <span class="mx-1">/</span>
                Budget: ${{ $campaign->budget !== null ? number_format($campaign->budget, 2) : 'TBD' }}
            </p>
        </div>

        <form action="{{ route('campaigns.apply.store', $campaign) }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="label" for="pitch">Pitch</label>
                <textarea id="pitch" name="pitch" rows="9" required class="textarea"
                    placeholder="Describe your audience fit, content approach, and delivery timeline.">{{ old('pitch') }}</textarea>
                <p class="muted mt-1 text-xs">Minimum 30 characters.</p>
            </div>

            <div>
                <label class="label" for="links">Portfolio and social links</label>
                <textarea id="links" name="links" rows="5" class="textarea"
                    placeholder="One URL per line">{{ old('links') }}</textarea>
            </div>

            <div class="flex flex-wrap gap-2">
                <button type="submit" class="btn-primary text-sm">Submit application</button>
                <a href="{{ route('campaigns.show', $campaign) }}" class="btn-secondary text-sm">Cancel</a>
            </div>
        </form>
    </section>
@endsection
