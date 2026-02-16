@php
    use App\Models\Creator;
    use App\Models\Promoter;

    $activeCreator = session('creator_id') ? Creator::find(session('creator_id')) : null;
    $activePromoter = session('promoter_id') ? Promoter::find(session('promoter_id')) : null;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CreatorHub')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f4f7fc;
            --ink: #111827;
            --muted: #63748f;
            --line: #dfe7f4;
            --card: #ffffff;
            --blue: #2563eb;
            --blue-ink: #eaf0ff;
            --green: #10b981;
            --amber: #f59e0b;
            --slate: #94a3b8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink);
            font-family: "Plus Jakarta Sans", sans-serif;
            background-color: var(--bg);
            background-image:
                radial-gradient(circle at 14% -2%, rgba(37, 99, 235, 0.09), transparent 32%),
                radial-gradient(circle at 90% 110%, rgba(59, 130, 246, 0.07), transparent 35%);
            background-attachment: fixed;
        }

        .headline {
            font-family: "Outfit", sans-serif;
            letter-spacing: -0.02em;
        }

        .surface {
            border: 1px solid var(--line);
            border-radius: 1.25rem;
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(8px);
            box-shadow: 0 20px 42px -34px rgba(15, 23, 42, 0.52);
        }

        .surface-strong {
            border: 1px solid var(--line);
            border-radius: 1.25rem;
            background: var(--card);
            box-shadow: 0 12px 34px -28px rgba(15, 23, 42, 0.40);
        }

        .muted {
            color: var(--muted);
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 40;
            background: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid var(--line);
            backdrop-filter: blur(8px);
        }

        .menu-link {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            border-radius: 0.65rem;
            color: #5d6d88;
            text-decoration: none;
            font-size: 0.94rem;
            font-weight: 600;
            padding: 0.42rem 0.58rem;
            transition: all 160ms ease;
        }

        .menu-link:hover {
            background: #eff4ff;
            color: #27457a;
        }

        .menu-link.is-active {
            color: var(--blue);
            background: #edf3ff;
        }

        .icon-dot {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.95rem;
            height: 1.95rem;
            border-radius: 999px;
            background: var(--blue);
            color: white;
            font-weight: 700;
            box-shadow: 0 8px 18px -12px rgba(37, 99, 235, 0.85);
        }

        .profile-bubble {
            width: 2rem;
            height: 2rem;
            border-radius: 999px;
            border: 1px solid #f1c6ae;
            background: #ffd9c5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.82rem;
            font-weight: 700;
            color: #7d3f1f;
        }

        .nav-pill {
            border: 1px solid var(--line);
            border-radius: 999px;
            background: #fff;
            padding: 0.28rem 0.62rem;
            font-size: 0.72rem;
            font-weight: 700;
            color: #50617b;
        }

        .btn-primary {
            border: 0;
            border-radius: 0.9rem;
            background: var(--blue);
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 0.7rem 1.05rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform 140ms ease, filter 140ms ease;
            box-shadow: 0 11px 24px -14px rgba(37, 99, 235, 0.72);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            filter: brightness(1.03);
        }

        .btn-secondary {
            border: 1px solid var(--line);
            border-radius: 0.9rem;
            background: #fff;
            color: #2c3f5e;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 0.68rem 1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 140ms ease;
        }

        .btn-secondary:hover {
            border-color: #c7d4ea;
            background: #f9fbff;
        }

        .field,
        .select,
        .textarea {
            width: 100%;
            border: 1px solid #ccd7ea;
            border-radius: 0.78rem;
            background: #fff;
            color: #112743;
            font-size: 0.9rem;
            padding: 0.66rem 0.76rem;
            outline: none;
            transition: border-color 160ms ease, box-shadow 160ms ease;
        }

        .textarea {
            min-height: 8rem;
            resize: vertical;
        }

        .field:focus,
        .select:focus,
        .textarea:focus {
            border-color: #8bb1f7;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.13);
        }

        .label {
            display: block;
            margin-bottom: 0.4rem;
            font-size: 0.74rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.09em;
            color: #5e7290;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            border: 1px solid #cfe0ff;
            background: var(--blue-ink);
            color: #2a56ac;
            padding: 0.24rem 0.62rem;
            font-size: 0.77rem;
            font-weight: 700;
        }

        .chip-brand {
            border-color: #c2f0df;
            background: #ebfff6;
            color: #0c8d63;
        }

        .meta-card {
            border: 1px solid #d6e0f1;
            border-radius: 0.82rem;
            background: #ffffff;
            padding: 0.62rem 0.72rem;
            font-size: 0.76rem;
            color: #5b6e89;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: 0.25rem 0.64rem;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .status-open {
            background: #e9fbf3;
            color: #0b9668;
        }

        .status-urgent {
            background: #fff7e8;
            color: #ce7a00;
        }

        .status-closed {
            background: #e9edf4;
            color: #64758f;
        }

        @keyframes fadeUp {
            0% {
                opacity: 0;
                transform: translateY(8px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .reveal {
            animation: fadeUp 320ms ease both;
        }

        .stagger>* {
            animation: fadeUp 400ms ease both;
        }

        .stagger>*:nth-child(1) {
            animation-delay: 40ms;
        }

        .stagger>*:nth-child(2) {
            animation-delay: 80ms;
        }

        .stagger>*:nth-child(3) {
            animation-delay: 120ms;
        }

        .stagger>*:nth-child(4) {
            animation-delay: 160ms;
        }

        .stagger>*:nth-child(5) {
            animation-delay: 200ms;
        }

        .stagger>*:nth-child(6) {
            animation-delay: 240ms;
        }

        @media (max-width: 780px) {
            .mobile-scroll {
                overflow-x: auto;
                padding-bottom: 0.3rem;
            }

            .mobile-scroll::-webkit-scrollbar {
                height: 6px;
            }

            .mobile-scroll::-webkit-scrollbar-thumb {
                background: #cfdbef;
                border-radius: 999px;
            }
        }
    </style>
</head>

<body>
    @php
        $isJobs = request()->routeIs('home') || request()->routeIs('campaigns.*');
        $isApplications = request()->routeIs('creator.applications');
        $isProfile = request()->routeIs('creator.*') || request()->routeIs('promoter.*');
    @endphp

    <header class="topbar">
        <div class="mx-auto flex max-w-5xl items-center justify-between gap-3 px-4 py-3">
            <div class="flex items-center gap-2">
                <span class="icon-dot">4</span>
                <a href="{{ route('campaigns.index') }}" class="headline text-2xl font-extrabold text-slate-900">CreatorHub</a>
            </div>

            <nav class="mobile-scroll items-center gap-2 flex">
                <a href="{{ route('campaigns.index') }}" class="menu-link {{ $isJobs ? 'is-active' : '' }}">Jobs</a>
                <a href="{{ route('creator.applications') }}" class="menu-link {{ $isApplications ? 'is-active' : '' }}">Applications</a>
                <a href="{{ route('creator.register') }}" class="menu-link {{ $isProfile ? 'is-active' : '' }}">Profile</a>
            </nav>

            <div class="flex items-center gap-3">
                <span class="relative inline-block text-slate-500">!</span>
                <span class="profile-bubble">M</span>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-5xl px-4 pb-12 pt-7">
        {{-- <div class="mb-4 flex flex-wrap gap-2 reveal">
            <span class="nav-pill">Creator: {{ $activeCreator?->display_name ?? 'none' }}</span>
            <span class="nav-pill">Promoter: {{ $activePromoter?->company_name ?? 'none' }}</span>
            <a href="{{ route('promoter.campaigns') }}" class="nav-pill">Dashboard</a>
            <a href="{{ route('campaigns.create') }}" class="nav-pill">Post</a>
        </div> --}}

        @if (session('status'))
            <div class="surface-strong mb-4 border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900 reveal">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="surface-strong mb-4 border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-900 reveal">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="surface-strong mb-4 border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900 reveal">
                <p class="mb-1 font-semibold">Please fix the following:</p>
                <ul class="ml-5 list-disc space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>

</html>
