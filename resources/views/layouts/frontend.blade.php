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
    <title>@yield('title', ($settings->site_name ?? 'E-Repository') . ' — Pusat Dokumen & Karya Ilmiah')</title>

    <!-- Google Fonts: Plus Jakarta Sans & Space Grotesk -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN with plugins -->
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
                        lavender: "#D8B4FE",
                        sky: "#7DD3FC",
                        peach: "#FDBA74",
                        pinkpop: "#FFA6C9",
                        dark: "#121212",
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Space Grotesk"', '"Plus Jakarta Sans"', 'sans-serif'],
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
        /* Custom Neobrutalism Utilities */
        .pattern-dots {
            background-image: radial-gradient(#121212 1.2px, transparent 1.2px);
            background-size: 24px 24px;
        }
        .pattern-grid {
            background-size: 32px 32px;
            background-image: 
                linear-gradient(to right, rgba(0, 0, 0, 0.07) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.07) 1px, transparent 1px);
        }
        .btn-brutal {
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-brutal:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px #000000;
        }
        .btn-brutal:active {
            transform: translate(2px, 2px);
            box-shadow: 1px 1px 0px #000000;
        }
        .card-brutal {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-brutal:hover {
            transform: translate(-3px, -3px);
            box-shadow: 8px 8px 0px #000000;
        }
        ::selection {
            background-color: #FFE600;
            color: #000000;
        }
    </style>
</head>

@php
    $settings = app(\App\Settings\GeneralSettings::class);
@endphp

<body class="bg-[#FAF7EE] text-dark font-sans overflow-x-hidden flex flex-col min-h-screen selection:bg-saweria selection:text-black">
    @if ($settings->site_active)
        <!-- Floating Announcement Bar -->
        <div class="bg-black text-white text-xs md:text-sm font-bold py-2 px-4 border-b-2 border-black flex items-center justify-center gap-2 overflow-hidden">
            <span class="inline-block px-2 py-0.5 bg-saweria text-black text-[11px] font-black rounded border border-black uppercase tracking-wider">Open Access</span>
            <span class="truncate">Repositori Karya Ilmiah & Dokumen Akademik Terbuka</span>
            <span class="hidden md:inline text-saweria">✦</span>
            <span class="hidden md:inline text-white/80">Akses Cepat, Mudah & Terverifikasi</span>
        </div>

        <!-- Neobrutalist Navbar -->
        <nav class="sticky top-0 z-[100] w-full bg-[#FFFDF7] border-b-4 border-black shadow-[0_4px_0px_#000000]">
            <div class="px-4 sm:px-8 lg:px-16 py-3.5 flex items-center justify-between max-w-[1440px] mx-auto">
                <!-- Logo & Brand -->
                <a class="flex items-center gap-3 group" href="{{ route('home') }}">
                    @if ($settings->site_logo)
                        <div class="p-1 bg-white border-2 border-black rounded-xl shadow-[3px_3px_0px_#000000] group-hover:rotate-2 group-hover:scale-105 transition-transform duration-200">
                            <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Logo" class="h-9 w-auto object-contain">
                        </div>
                    @else
                        <div class="size-11 bg-saweria rounded-xl border-3 border-black shadow-[3px_3px_0px_#000000] flex items-center justify-center text-dark group-hover:rotate-6 group-hover:scale-105 transition-all duration-200">
                            <span class="material-symbols-outlined text-2xl font-bold">menu_book</span>
                        </div>
                    @endif

                    <div class="flex flex-col">
                        <span class="text-xl md:text-2xl font-black tracking-tight text-black flex items-center gap-1">
                            {{ $settings->site_name ?? 'E-Repository' }}
                            <span class="text-xs bg-black text-saweria px-1.5 py-0.5 rounded font-black border border-black uppercase tracking-wider">v2.0</span>
                        </span>
                        <span class="text-[11px] font-bold text-neutral-600 tracking-wide uppercase -mt-0.5 hidden sm:block">
                            Digital Academic Archive
                        </span>
                    </div>
                </a>

                <!-- Right Actions -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 bg-white text-dark font-bold text-sm border-2 border-black rounded-xl shadow-brutal-sm hover:-translate-y-0.5 hover:shadow-brutal active:translate-x-0.5 active:translate-y-0.5 transition-all">
                        <span class="material-symbols-outlined text-[18px]">search</span>
                        <span>Cari Dokumen</span>
                    </a>

                    <a href="/admin" title="Panel Administrator" class="inline-flex items-center gap-2 px-4 py-2 bg-saweria text-dark font-extrabold text-sm border-2 border-black rounded-xl shadow-brutal hover:-translate-y-0.5 hover:shadow-brutal-md active:translate-x-0.5 active:translate-y-0.5 active:shadow-brutal-sm transition-all">
                        <span class="material-symbols-outlined text-[20px]">admin_panel_settings</span>
                        <span class="hidden xs:inline">Admin Panel</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main Content Slot -->
        @yield('content')

        <!-- Neobrutalist Footer -->
        <footer class="bg-[#FFFDF7] border-t-4 border-black mt-auto relative z-10">
            <!-- Strip Dekoratif Atas Footer -->
            <div class="h-3 bg-saweria border-b-2 border-black flex">
                <div class="w-1/4 bg-coral border-r-2 border-black"></div>
                <div class="w-1/4 bg-mint border-r-2 border-black"></div>
                <div class="w-1/4 bg-sky border-r-2 border-black"></div>
                <div class="w-1/4 bg-lavender"></div>
            </div>

            <div class="max-w-[1440px] mx-auto px-4 sm:px-8 lg:px-16 py-12">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-10">
                    <!-- Kolom 1: Brand Info -->
                    <div class="md:col-span-5 space-y-4">
                        <div class="flex items-center gap-3">
                            @if ($settings->site_logo)
                                <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Logo" class="h-10 w-auto object-contain">
                            @else
                                <div class="size-10 bg-saweria rounded-xl border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center">
                                    <span class="material-symbols-outlined text-xl font-bold">menu_book</span>
                                </div>
                            @endif
                            <span class="font-black text-2xl text-black">{{ $settings->site_name ?? 'E-Repository' }}</span>
                        </div>

                        <p class="text-sm font-medium leading-relaxed text-neutral-700 max-w-sm">
                            {{ $settings->footer_text ?? 'Repositori dokumen terbuka untuk mendukung publikasi dan transparansi riset civitas akademika.' }}
                        </p>

                        <div class="flex flex-wrap gap-2 pt-2">
                            <span class="px-3 py-1 bg-white text-dark text-xs font-extrabold border-2 border-black rounded-lg shadow-brutal-sm">
                                🎓 Karya Ilmiah
                            </span>
                            <span class="px-3 py-1 bg-mint text-dark text-xs font-extrabold border-2 border-black rounded-lg shadow-brutal-sm">
                                📑 Skripsi & Tesis
                            </span>
                            <span class="px-3 py-1 bg-lavender text-dark text-xs font-extrabold border-2 border-black rounded-lg shadow-brutal-sm">
                                📚 Jurnal Terbuka
                            </span>
                        </div>
                    </div>

                    <!-- Kolom 2: Kontak & Alamat -->
                    <div class="md:col-span-4 space-y-3">
                        <h4 class="text-base font-black text-black uppercase tracking-wider flex items-center gap-2">
                            <span class="size-3 bg-coral rounded-full border border-black inline-block"></span>
                            Kontak & Lokasi
                        </h4>
                        
                        <div class="space-y-2.5 text-sm font-semibold text-neutral-800">
                            @if ($settings->site_address)
                                <div class="flex items-start gap-2.5 p-2.5 bg-white border-2 border-black rounded-xl shadow-brutal-sm">
                                    <span class="material-symbols-outlined text-coral text-[20px] shrink-0 mt-0.5">location_on</span>
                                    <span>{{ $settings->site_address }}</span>
                                </div>
                            @endif

                            @if ($settings->site_email)
                                <a href="mailto:{{ $settings->site_email }}" class="flex items-center gap-2.5 p-2.5 bg-white border-2 border-black rounded-xl shadow-brutal-sm hover:bg-sky/20 transition-colors">
                                    <span class="material-symbols-outlined text-sky text-[20px] shrink-0">mail</span>
                                    <span class="truncate">{{ $settings->site_email }}</span>
                                </a>
                            @endif

                            @if ($settings->site_phone)
                                @php
                                    $phoneClean = preg_replace('/[^0-9]/', '', $settings->site_phone);
                                    if (substr($phoneClean, 0, 1) == '0') {
                                        $phoneClean = '62' . substr($phoneClean, 1);
                                    }
                                @endphp
                                <a href="https://wa.me/{{ $phoneClean }}" target="_blank" class="flex items-center gap-2.5 p-2.5 bg-white border-2 border-black rounded-xl shadow-brutal-sm hover:bg-mint/20 transition-colors">
                                    <span class="material-symbols-outlined text-mint text-[20px] shrink-0">call</span>
                                    <span>{{ $settings->site_phone }} (WhatsApp)</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Kolom 3: Quick Info Card -->
                    <div class="md:col-span-3">
                        <div class="p-5 bg-saweria border-3 border-black rounded-2xl shadow-brutal space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="text-xl">⚡</span>
                                <h5 class="font-black text-black text-sm uppercase">Akses Cepat</h5>
                            </div>
                            <p class="text-xs font-semibold text-neutral-800 leading-relaxed">
                                Unduh dokumen format PDF secara gratis untuk keperluan referensi dan sitasi akademik.
                            </p>
                            <a href="{{ route('home') }}#koleksi" class="inline-flex items-center gap-1 text-xs font-black bg-black text-white px-3 py-1.5 rounded-lg border border-black hover:bg-neutral-800 transition-colors">
                                Jelajahi Sekarang →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Copyright Banner -->
                <div class="pt-6 border-t-2 border-black flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-bold text-neutral-600">
                    <p>
                        {{ $settings->site_footer ?? '© ' . date('Y') . ' ' . ($settings->site_name ?? 'E-Repository') . '. All rights reserved.' }}
                    </p>
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-0.5 bg-black text-saweria rounded font-black border border-black">Neobrutalism UI</span>
                        <span>Designed with ⚡ for Academics</span>
                    </div>
                </div>
            </div>
        </footer>
    @else
        <!-- Neobrutalist Maintenance Mode -->
        <div class="min-h-screen w-full flex items-center justify-center p-6 pattern-dots bg-[#FAF7EE]">
            <div class="max-w-md w-full p-8 bg-white border-4 border-black rounded-3xl shadow-brutal-lg text-center space-y-5">
                <div class="size-20 bg-saweria border-3 border-black rounded-2xl shadow-brutal mx-auto flex items-center justify-center text-4xl">
                    🚧
                </div>
                <div class="space-y-2">
                    <span class="px-3 py-1 bg-coral text-white text-xs font-black uppercase rounded-lg border-2 border-black shadow-brutal-sm inline-block">
                        Maintenance Mode
                    </span>
                    <h1 class="text-3xl font-black text-black">Sedang Dalam Pemeliharaan</h1>
                    <p class="text-sm font-semibold text-neutral-600 leading-relaxed">
                        Sistem repositori sedang ditingkatkan untuk kenyamanan riset Anda. Silakan kembali dalam beberapa saat.
                    </p>
                </div>
                <a href="/admin" class="inline-flex items-center gap-2 px-6 py-3 bg-black text-white text-sm font-black rounded-xl border-2 border-black shadow-brutal hover:bg-neutral-800 transition-all">
                    <span>Login Admin</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>
        </div>
    @endif
</body>

</html>
