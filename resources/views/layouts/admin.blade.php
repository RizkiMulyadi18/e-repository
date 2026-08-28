<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    @php
        $settings = app(\App\Settings\GeneralSettings::class);
        $favicon = $settings->site_logo ? asset('storage/' . $settings->site_logo) : asset('favicon.svg');
    @endphp
    <link rel="icon" type="image/svg+xml" href="{{ $favicon }}">
    <link rel="alternate icon" href="{{ asset('favicon.svg') }}">
    <title>@yield('title', 'Admin Panel') — {{ $settings->site_name ?? 'E-Repository' }}</title>

    <!-- Google Fonts: Plus Jakarta Sans & Space Grotesk -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">

    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Tailwind Configuration -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        cream: "#FAF7EE",
                        "cream-light": "#FFFDF7",
                        saweria: "#FFE600",
                        "saweria-hover": "#F0D800",
                        coral: "#FF6B6B",
                        mint: "#4ECCA3",
                        sky: "#7DD3FC",
                        lavender: "#D8B4FE",
                        pinkpop: "#FFA6C9",
                        peach: "#FDBA74",
                        dark: "#121212",
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Space Grotesk"', 'sans-serif'],
                    },
                    boxShadow: {
                        'brutal-sm': '2px 2px 0px #000000',
                        'brutal': '4px 4px 0px #000000',
                        'brutal-md': '6px 6px 0px #000000',
                        'brutal-lg': '8px 8px 0px #000000',
                        'brutal-xl': '12px 12px 0px #000000',
                    },
                    borderWidth: {
                        '3': '3px',
                        '4': '4px',
                    },
                },
            },
        };
    </script>

    <style>
        .pattern-dots {
            background-image: radial-gradient(#121212 1.2px, transparent 1.2px);
            background-size: 24px 24px;
        }
        .pattern-grid {
            background-size: 28px 28px;
            background-image: 
                linear-gradient(to right, rgba(0, 0, 0, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.05) 1px, transparent 1px);
        }
        [x-cloak] { display: none !important; }
    </style>
    @livewireStyles
</head>

<body class="bg-[#FAF7EE] text-dark font-sans min-h-screen flex flex-col antialiased selection:bg-saweria selection:text-black" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar Overlay (Mobile) -->
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm lg:hidden"></div>

        <!-- Neobrutalist Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 bg-[#FFFDF7] border-r-4 border-black flex flex-col transition-transform duration-200 ease-in-out lg:static lg:translate-x-0">
            
            <!-- Sidebar Header -->
            <div class="p-5 border-b-3 border-black flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                    @if ($settings->site_logo)
                        <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Logo" class="h-8 w-auto object-contain">
                    @else
                        <div class="size-9 bg-saweria rounded-xl border-2 border-black shadow-brutal-sm flex items-center justify-center font-bold">
                            <span class="material-symbols-outlined text-lg">menu_book</span>
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <span class="font-black text-lg text-black tracking-tight leading-tight">{{ $settings->site_name ?? 'E-Repository' }}</span>
                        <span class="text-[10px] font-black uppercase text-neutral-500 tracking-wider">Admin Panel</span>
                    </div>
                </a>

                <button @click="sidebarOpen = false" class="lg:hidden size-8 bg-white border-2 border-black rounded-lg flex items-center justify-center shadow-brutal-sm">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <!-- User Info Badge in Sidebar -->
            <div class="p-4 mx-4 mt-4 bg-white border-2 border-black rounded-2xl shadow-brutal-sm flex items-center gap-3">
                <div class="size-10 bg-saweria rounded-xl border-2 border-black flex items-center justify-center font-black text-black text-base shadow-[2px_2px_0px_#000]">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-black text-black truncate">{{ auth()->user()->name }}</p>
                    <span class="inline-block mt-0.5 px-2 py-0.5 text-[10px] font-black uppercase rounded-md border border-black {{ auth()->user()->role === 'admin' ? 'bg-saweria text-black' : 'bg-mint text-black' }}">
                        {{ auth()->user()->role === 'admin' ? '👑 Administrator' : '✍️ Editor' }}
                    </span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-4 space-y-1.5 overflow-y-auto">
                <div class="px-2 pb-1 text-[10px] font-black uppercase text-neutral-400 tracking-wider">Menu Utama</div>

                <!-- Dashboard Link -->
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl border-2 font-black text-xs uppercase tracking-wider transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-saweria text-black border-black shadow-brutal-sm translate-x-1' : 'bg-white hover:bg-neutral-50 text-neutral-800 border-transparent hover:border-black hover:shadow-brutal-sm' }}">
                    <span class="material-symbols-outlined text-[20px]">dashboard</span>
                    <span>Dashboard</span>
                </a>

                <!-- Dokumen Link -->
                <a href="{{ route('admin.dokumens') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl border-2 font-black text-xs uppercase tracking-wider transition-all {{ request()->routeIs('admin.dokumens*') ? 'bg-saweria text-black border-black shadow-brutal-sm translate-x-1' : 'bg-white hover:bg-neutral-50 text-neutral-800 border-transparent hover:border-black hover:shadow-brutal-sm' }}">
                    <span class="material-symbols-outlined text-[20px]">description</span>
                    <span>Kelola Dokumen</span>
                </a>

                <!-- Kategori Link -->
                <a href="{{ route('admin.categories') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl border-2 font-black text-xs uppercase tracking-wider transition-all {{ request()->routeIs('admin.categories*') ? 'bg-saweria text-black border-black shadow-brutal-sm translate-x-1' : 'bg-white hover:bg-neutral-50 text-neutral-800 border-transparent hover:border-black hover:shadow-brutal-sm' }}">
                    <span class="material-symbols-outlined text-[20px]">category</span>
                    <span>Kelola Kategori</span>
                </a>

                <!-- Admin Only Section -->
                @can('admin-only')
                    <div class="pt-4 px-2 pb-1 text-[10px] font-black uppercase text-neutral-400 tracking-wider">Konfigurasi</div>

                    <!-- Pengguna Link -->
                    <a href="{{ route('admin.users') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl border-2 font-black text-xs uppercase tracking-wider transition-all {{ request()->routeIs('admin.users*') ? 'bg-saweria text-black border-black shadow-brutal-sm translate-x-1' : 'bg-white hover:bg-neutral-50 text-neutral-800 border-transparent hover:border-black hover:shadow-brutal-sm' }}">
                        <span class="material-symbols-outlined text-[20px]">group</span>
                        <span>Kelola Pengguna</span>
                    </a>

                    <!-- Settings Link -->
                    <a href="{{ route('admin.settings') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl border-2 font-black text-xs uppercase tracking-wider transition-all {{ request()->routeIs('admin.settings*') ? 'bg-saweria text-black border-black shadow-brutal-sm translate-x-1' : 'bg-white hover:bg-neutral-50 text-neutral-800 border-transparent hover:border-black hover:shadow-brutal-sm' }}">
                        <span class="material-symbols-outlined text-[20px]">settings</span>
                        <span>Pengaturan Web</span>
                    </a>
                @endcan

                <div class="pt-4 px-2 pb-1 text-[10px] font-black uppercase text-neutral-400 tracking-wider">Lainnya</div>

                <!-- Cetak PDF -->
                <a href="{{ route('admin.laporan.cetak') }}" target="_blank"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl border-2 border-transparent hover:border-black bg-white hover:bg-mint text-neutral-800 font-black text-xs uppercase tracking-wider transition-all hover:shadow-brutal-sm">
                    <span class="material-symbols-outlined text-[20px]">print</span>
                    <span>Cetak Rekap PDF</span>
                </a>

                <!-- Lihat Web Publik -->
                <a href="{{ route('home') }}" target="_blank"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl border-2 border-transparent hover:border-black bg-white hover:bg-sky text-neutral-800 font-black text-xs uppercase tracking-wider transition-all hover:shadow-brutal-sm">
                    <span class="material-symbols-outlined text-[20px]">open_in_new</span>
                    <span>Website Publik</span>
                </a>
            </nav>

            <!-- Sidebar Footer Logout -->
            <div class="p-4 border-t-3 border-black bg-white">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full py-2.5 px-3 bg-coral hover:bg-[#ff5252] text-white font-black text-xs uppercase rounded-xl border-2 border-black shadow-brutal-sm hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center justify-center gap-2 cursor-pointer">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                        <span>Keluar (Logout)</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <!-- Topbar Header -->
            <header class="bg-[#FFFDF7] border-b-3 border-black shadow-[0_3px_0px_#000000] px-4 sm:px-8 py-3.5 flex items-center justify-between z-30 shrink-0">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="lg:hidden size-10 bg-white border-2 border-black rounded-xl flex items-center justify-center shadow-brutal-sm">
                        <span class="material-symbols-outlined text-xl">menu</span>
                    </button>
                    <div>
                        <h1 class="text-base sm:text-xl font-black text-black tracking-tight leading-tight">
                            @yield('header', 'Dashboard')
                        </h1>
                        <p class="text-[11px] font-bold text-neutral-500 hidden sm:block">
                            Sistem Manajemen E-Repository
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-white border-2 border-black rounded-xl text-xs font-bold shadow-brutal-sm hover:bg-neutral-50 transition-all">
                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                        <span>Lihat Web</span>
                    </a>
                </div>
            </header>

            <!-- Scrollable Content View -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-8 bg-[#FAF7EE] pattern-grid">
                
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mb-6 p-4 bg-mint/20 border-3 border-black rounded-2xl shadow-brutal flex items-center justify-between gap-3 text-sm font-bold text-black" x-data="{ show: true }" x-show="show">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-2xl font-bold">check_circle</span>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="size-7 bg-white border border-black rounded-lg flex items-center justify-center">✕</button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 bg-coral/20 border-3 border-black rounded-2xl shadow-brutal flex items-center justify-between gap-3 text-sm font-bold text-black" x-data="{ show: true }" x-show="show">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-2xl font-bold">error</span>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button @click="show = false" class="size-7 bg-white border border-black rounded-lg flex items-center justify-center">✕</button>
                    </div>
                @endif

                @yield('content')
                {{ $slot ?? '' }}

            </main>
        </div>

    </div>

    @livewireScripts
</body>

</html>
