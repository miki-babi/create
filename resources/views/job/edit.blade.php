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
                <button type="button" id="open-delete-campaign-modal"
                    class="inline-flex items-center justify-center rounded-[0.9rem] border border-rose-200 bg-rose-50 px-4 py-[0.68rem] text-sm font-bold text-rose-700 transition hover:border-rose-300 hover:bg-rose-100">
                    Delete campaign
                </button>
            </div>
        </form>
    </section>

    <div id="delete-campaign-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 px-4"
        role="dialog" aria-modal="true" aria-labelledby="delete-campaign-modal-title">
        <div class="surface-strong w-full max-w-md p-5 md:p-6">
            <h2 id="delete-campaign-modal-title" class="headline text-2xl font-extrabold text-slate-900">Delete campaign?</h2>
            <p class="muted mt-2 text-sm">
                This action cannot be undone. Your campaign and all related applications will be permanently removed.
            </p>

            <div class="mt-5 flex flex-wrap gap-2">
                <button type="button" id="close-delete-campaign-modal" class="btn-secondary text-sm">Cancel</button>

                <form action="{{ route('campaigns.delete', $campaign) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-[0.9rem] bg-rose-600 px-4 py-[0.68rem] text-sm font-bold text-white transition hover:bg-rose-700">
                        Yes, delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const modal = document.getElementById('delete-campaign-modal');
            const openButton = document.getElementById('open-delete-campaign-modal');
            const closeButton = document.getElementById('close-delete-campaign-modal');

            if (!modal || !openButton || !closeButton) {
                return;
            }

            const openModal = () => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            };

            const closeModal = () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            };

            openButton.addEventListener('click', openModal);
            closeButton.addEventListener('click', closeModal);

            modal.addEventListener('click', (event) => {
                if (event.target === modal) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closeModal();
                }
            });
        })();
    </script>
@endsection
