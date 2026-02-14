<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Creator Jobs Feed</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#256af4",
                        "background-light": "#f5f6f8",
                        "background-dark": "#101622",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .job-card-shadow {
            box-shadow: 0 4px 12px rgba(37, 106, 244, 0.05);
        }

        .job-card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 106, 244, 0.08);
            border-color: #256af4;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen">
    <!-- Top Navigation Bar -->
    <header
        class="sticky top-0 z-50 bg-white dark:bg-slate-900 border-b border-primary/10 dark:border-white/10 px-6 py-2">
        <div class="max-w-4xl mx-auto flex items-center ">
            <div class="flex items-center gap-4 w-full justify-between">
                <button class="p-2 text-slate-400 hover:text-primary transition-colors relative">
                    <span class="material-icons">notifications</span>
                    <span
                        class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white dark:border-slate-900"></span>
                </button>
                <div class="w-10 h-10 rounded-full border border-primary/20 overflow-hidden">
                    <img class="w-full h-full object-cover" data-alt="User profile avatar photo"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCTVWmT5I-weWbMsMY1esiNzvUJf4n21lj5EfZYySHxivLQJXnhQPXpqPrMgN8Z6d5syhDqfBtdvnxwQoORQY54lRqwI6d98Ch1jijwkV_7SjVfG4YLjZqBtgiexQq20jW0ZoumgWP6wOWIJLRgo6SPluRzMwMCSJnGwa9OFTfrfZpqJ5gOWj-lOtM_Kj9gWY_AdclWCQkStU2jHVmzbgE2ymlgaVaF1MWqeC1DAZbduKPSVKGD4BW31098OFBr__u9rVptctx-xK4" />
                </div>
            </div>
        </div>
    </header>
    <main class="max-w-4xl mx-auto px-6 py-10">
        <!-- Feed Header & Filters -->
        <div class="mb-10">
            <div class="flex flex-col md:flex-row md:items-center justify-end gap-4">
                {{-- <div>
                    <h1 class="text-3xl font-bold mb-2">Jobs</h1>
                    <p class="text-slate-500 dark:text-slate-400">Explore the best brand opportunities for your niche.
                    </p>
                </div> --}}
                <div class="flex gap-2">
                    <button
                        class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800 border border-primary/10 dark:border-white/10 rounded-lg text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                        <span class="material-icons text-sm">tune</span>

                    </button>
                    <button
                        class="flex w-full items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:opacity-90 transition-all shadow-lg shadow-primary/20">
                        <span class="material-icons text-sm">search</span>
                        Search
                    </button>
                </div>
            </div>
        </div>
        <!-- Jobs Feed -->
        <div class="space-y-6">
            <!-- Job Card 1 -->
            <div
                class="bg-white dark:bg-slate-900 rounded-xl p-6 border border-primary/10 dark:border-white/5 job-card-shadow job-card-hover transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex gap-4">
                        <div
                            class="w-12 h-12 rounded-lg bg-slate-50 dark:bg-slate-800 flex items-center justify-center p-2 border border-primary/5">
                            <img class="w-full h-full object-contain" data-alt="Company logo for a tech brand"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfq0fFVyI7CXTlsdJjmQFP7rDry-tOE_5iUYHLhkqDEHmW5FLX7Mp1a9SM16KDIo0dgUmb9Wo3k31mYYTCJSm0qgdf9Wu4AUfEkTJnPvgd9e3pp5z709nOrtJzzW3Zs8DSXaAcuONhqUWIKSggZ58nsNYt6sqOlNqsEZ5VZlM393tUDzxYIhAuTimLrQTiQxSAHDs27brpbpe0-1DQK093CjhSXuZCJ4-yLTlJztiX3Bv898DhTCAQFWbazuy2ju3PCRdhZzl9eug" />
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white leading-tight mb-1">Summer Tech
                                Review Series</h3>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-medium text-slate-500 dark:text-slate-400">NextGen Gear
                                    Co.</span>
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <span class="text-xs font-medium text-slate-500">2 hours ago</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 mb-6">
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#Tech</span>
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#YouTube</span>
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#Instagram</span>
                    <span
                        class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-semibold rounded-full border border-slate-200 dark:border-slate-700">Long-term</span>
                </div>
                <div>

                    <span
                        class="px-3 py-1 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-xs font-bold rounded-full uppercase tracking-wider">Open</span>
                    <span class="text-lg font-bold text-slate-900 dark:text-white">$1,200 - $1,800</span>

                </div>

                <div class="flex items-center justify-center pt-6 border-t border-slate-50 dark:border-slate-800">

                    <button
                        class="bg-primary hover:bg-primary/90 text-white px-6 py-2.5 rounded-lg font-bold text-sm transition-all flex items-center gap-2 group shadow-md shadow-primary/10">
                        View Details
                        <span
                            class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </div>
            </div>
            <div
                class="bg-white dark:bg-slate-900 rounded-xl p-6 border border-primary/10 dark:border-white/5 job-card-shadow job-card-hover transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex gap-4">
                        <div
                            class="w-12 h-12 rounded-lg bg-slate-50 dark:bg-slate-800 flex items-center justify-center p-2 border border-primary/5">
                            <img class="w-full h-full object-contain" data-alt="Company logo for a tech brand"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfq0fFVyI7CXTlsdJjmQFP7rDry-tOE_5iUYHLhkqDEHmW5FLX7Mp1a9SM16KDIo0dgUmb9Wo3k31mYYTCJSm0qgdf9Wu4AUfEkTJnPvgd9e3pp5z709nOrtJzzW3Zs8DSXaAcuONhqUWIKSggZ58nsNYt6sqOlNqsEZ5VZlM393tUDzxYIhAuTimLrQTiQxSAHDs27brpbpe0-1DQK093CjhSXuZCJ4-yLTlJztiX3Bv898DhTCAQFWbazuy2ju3PCRdhZzl9eug" />
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white leading-tight mb-1">Summer Tech
                                Review Series</h3>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-medium text-slate-500 dark:text-slate-400">NextGen Gear
                                    Co.</span>
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <span class="text-xs font-medium text-slate-500">2 hours ago</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 mb-6">
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#Tech</span>
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#YouTube</span>
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#Instagram</span>
                    <span
                        class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-semibold rounded-full border border-slate-200 dark:border-slate-700">Long-term</span>
                </div>
                <div>

                    <span
                        class="px-3 py-1 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-xs font-bold rounded-full uppercase tracking-wider">Open</span>
                    <span class="text-lg font-bold text-slate-900 dark:text-white">$1,200 - $1,800</span>

                </div>

                <div class="flex items-center justify-center pt-6 border-t border-slate-50 dark:border-slate-800">

                    <button
                        class="bg-primary hover:bg-primary/90 text-white px-6 py-2.5 rounded-lg font-bold text-sm transition-all flex items-center gap-2 group shadow-md shadow-primary/10">
                        View Details
                        <span
                            class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </div>
            </div>
            <div
                class="bg-white dark:bg-slate-900 rounded-xl p-6 border border-primary/10 dark:border-white/5 job-card-shadow job-card-hover transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex gap-4">
                        <div
                            class="w-12 h-12 rounded-lg bg-slate-50 dark:bg-slate-800 flex items-center justify-center p-2 border border-primary/5">
                            <img class="w-full h-full object-contain" data-alt="Company logo for a tech brand"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfq0fFVyI7CXTlsdJjmQFP7rDry-tOE_5iUYHLhkqDEHmW5FLX7Mp1a9SM16KDIo0dgUmb9Wo3k31mYYTCJSm0qgdf9Wu4AUfEkTJnPvgd9e3pp5z709nOrtJzzW3Zs8DSXaAcuONhqUWIKSggZ58nsNYt6sqOlNqsEZ5VZlM393tUDzxYIhAuTimLrQTiQxSAHDs27brpbpe0-1DQK093CjhSXuZCJ4-yLTlJztiX3Bv898DhTCAQFWbazuy2ju3PCRdhZzl9eug" />
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white leading-tight mb-1">Summer Tech
                                Review Series</h3>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-medium text-slate-500 dark:text-slate-400">NextGen Gear
                                    Co.</span>
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <span class="text-xs font-medium text-slate-500">2 hours ago</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 mb-6">
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#Tech</span>
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#YouTube</span>
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#Instagram</span>
                    <span
                        class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-semibold rounded-full border border-slate-200 dark:border-slate-700">Long-term</span>
                </div>
                <div>

                    <span
                        class="px-3 py-1 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-xs font-bold rounded-full uppercase tracking-wider">Open</span>
                    <span class="text-lg font-bold text-slate-900 dark:text-white">$1,200 - $1,800</span>

                </div>

                <div class="flex items-center justify-center pt-6 border-t border-slate-50 dark:border-slate-800">

                    <button
                        class="bg-primary hover:bg-primary/90 text-white px-6 py-2.5 rounded-lg font-bold text-sm transition-all flex items-center gap-2 group shadow-md shadow-primary/10">
                        View Details
                        <span
                            class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </div>
            </div>
            <div
                class="bg-white dark:bg-slate-900 rounded-xl p-6 border border-primary/10 dark:border-white/5 job-card-shadow job-card-hover transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex gap-4">
                        <div
                            class="w-12 h-12 rounded-lg bg-slate-50 dark:bg-slate-800 flex items-center justify-center p-2 border border-primary/5">
                            <img class="w-full h-full object-contain" data-alt="Company logo for a tech brand"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfq0fFVyI7CXTlsdJjmQFP7rDry-tOE_5iUYHLhkqDEHmW5FLX7Mp1a9SM16KDIo0dgUmb9Wo3k31mYYTCJSm0qgdf9Wu4AUfEkTJnPvgd9e3pp5z709nOrtJzzW3Zs8DSXaAcuONhqUWIKSggZ58nsNYt6sqOlNqsEZ5VZlM393tUDzxYIhAuTimLrQTiQxSAHDs27brpbpe0-1DQK093CjhSXuZCJ4-yLTlJztiX3Bv898DhTCAQFWbazuy2ju3PCRdhZzl9eug" />
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white leading-tight mb-1">Summer Tech
                                Review Series</h3>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-medium text-slate-500 dark:text-slate-400">NextGen Gear
                                    Co.</span>
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <span class="text-xs font-medium text-slate-500">2 hours ago</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 mb-6">
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#Tech</span>
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#YouTube</span>
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#Instagram</span>
                    <span
                        class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-semibold rounded-full border border-slate-200 dark:border-slate-700">Long-term</span>
                </div>
                <div>

                    <span
                        class="px-3 py-1 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-xs font-bold rounded-full uppercase tracking-wider">Open</span>
                    <span class="text-lg font-bold text-slate-900 dark:text-white">$1,200 - $1,800</span>

                </div>

                <div class="flex items-center justify-center pt-6 border-t border-slate-50 dark:border-slate-800">

                    <button
                        class="bg-primary hover:bg-primary/90 text-white px-6 py-2.5 rounded-lg font-bold text-sm transition-all flex items-center gap-2 group shadow-md shadow-primary/10">
                        View Details
                        <span
                            class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </div>
            </div>
            <div
                class="bg-white dark:bg-slate-900 rounded-xl p-6 border border-primary/10 dark:border-white/5 job-card-shadow job-card-hover transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex gap-4">
                        <div
                            class="w-12 h-12 rounded-lg bg-slate-50 dark:bg-slate-800 flex items-center justify-center p-2 border border-primary/5">
                            <img class="w-full h-full object-contain" data-alt="Company logo for a tech brand"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfq0fFVyI7CXTlsdJjmQFP7rDry-tOE_5iUYHLhkqDEHmW5FLX7Mp1a9SM16KDIo0dgUmb9Wo3k31mYYTCJSm0qgdf9Wu4AUfEkTJnPvgd9e3pp5z709nOrtJzzW3Zs8DSXaAcuONhqUWIKSggZ58nsNYt6sqOlNqsEZ5VZlM393tUDzxYIhAuTimLrQTiQxSAHDs27brpbpe0-1DQK093CjhSXuZCJ4-yLTlJztiX3Bv898DhTCAQFWbazuy2ju3PCRdhZzl9eug" />
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white leading-tight mb-1">Summer Tech
                                Review Series</h3>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-medium text-slate-500 dark:text-slate-400">NextGen Gear
                                    Co.</span>
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <span class="text-xs font-medium text-slate-500">2 hours ago</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 mb-6">
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#Tech</span>
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#YouTube</span>
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#Instagram</span>
                    <span
                        class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-semibold rounded-full border border-slate-200 dark:border-slate-700">Long-term</span>
                </div>
                <div>

                    <span
                        class="px-3 py-1 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-xs font-bold rounded-full uppercase tracking-wider">Open</span>
                    <span class="text-lg font-bold text-slate-900 dark:text-white">$1,200 - $1,800</span>

                </div>

                <div class="flex items-center justify-center pt-6 border-t border-slate-50 dark:border-slate-800">

                    <button
                        class="bg-primary hover:bg-primary/90 text-white px-6 py-2.5 rounded-lg font-bold text-sm transition-all flex items-center gap-2 group shadow-md shadow-primary/10">
                        View Details
                        <span
                            class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </div>
            </div>
            <div
                class="bg-white dark:bg-slate-900 rounded-xl p-6 border border-primary/10 dark:border-white/5 job-card-shadow job-card-hover transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex gap-4">
                        <div
                            class="w-12 h-12 rounded-lg bg-slate-50 dark:bg-slate-800 flex items-center justify-center p-2 border border-primary/5">
                            <img class="w-full h-full object-contain" data-alt="Company logo for a tech brand"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfq0fFVyI7CXTlsdJjmQFP7rDry-tOE_5iUYHLhkqDEHmW5FLX7Mp1a9SM16KDIo0dgUmb9Wo3k31mYYTCJSm0qgdf9Wu4AUfEkTJnPvgd9e3pp5z709nOrtJzzW3Zs8DSXaAcuONhqUWIKSggZ58nsNYt6sqOlNqsEZ5VZlM393tUDzxYIhAuTimLrQTiQxSAHDs27brpbpe0-1DQK093CjhSXuZCJ4-yLTlJztiX3Bv898DhTCAQFWbazuy2ju3PCRdhZzl9eug" />
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white leading-tight mb-1">Summer Tech
                                Review Series</h3>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-medium text-slate-500 dark:text-slate-400">NextGen Gear
                                    Co.</span>
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <span class="text-xs font-medium text-slate-500">2 hours ago</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 mb-6">
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#Tech</span>
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#YouTube</span>
                    <span
                        class="px-3 py-1 bg-primary/5 dark:bg-primary/10 text-primary text-xs font-semibold rounded-full border border-primary/10">#Instagram</span>
                    <span
                        class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-semibold rounded-full border border-slate-200 dark:border-slate-700">Long-term</span>
                </div>
                <div>

                    <span
                        class="px-3 py-1 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-xs font-bold rounded-full uppercase tracking-wider">Open</span>
                    <span class="text-lg font-bold text-slate-900 dark:text-white">$1,200 - $1,800</span>

                </div>

                <div class="flex items-center justify-center pt-6 border-t border-slate-50 dark:border-slate-800">

                    <button
                        class="bg-primary hover:bg-primary/90 text-white px-6 py-2.5 rounded-lg font-bold text-sm transition-all flex items-center gap-2 group shadow-md shadow-primary/10">
                        View Details
                        <span
                            class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </div>
            </div>

        </div>
        <!-- Load More Section -->
        <div class="mt-12 text-center">
            <button
                class="px-8 py-3 bg-white dark:bg-slate-900 border border-primary/20 dark:border-white/10 text-primary font-bold rounded-xl hover:bg-primary hover:text-white transition-all duration-300 shadow-sm">
                Load More Opportunities
            </button>
        </div>
    </main>
    <!-- Floating Action Button for Mobile Context (Just for UI completeness) -->
    <div class="fixed bottom-8 right-8 md:hidden">
        <button
            class="w-14 h-14 bg-primary text-white rounded-full flex items-center justify-center shadow-2xl shadow-primary/40">
            <span class="material-icons">filter_list</span>
        </button>
    </div>
</body>

</html>
