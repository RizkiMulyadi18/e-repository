<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    @php
        $settings = app(\App\Settings\GeneralSettings::class);
        // Jika ada logo upload, pakai itu. Jika tidak, pakai favicon bawaan Laravel
        $favicon = $settings->site_logo ? asset('storage/' . $settings->site_logo) : asset('favicon.ico');
    @endphp
    <link rel="icon" href="{{ $favicon }}">
    <title>{{ $settings->site_name }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&amp;display=swap" rel="stylesheet" />
    <!-- Material Symbols -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Tailwind Configuration -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#1e3b8a", // Deep Navy Blue
                        accent: "#f59e0b", // Golden Amber
                        "background-light": "#f6f6f8",
                        "background-dark": "#121620",
                    },
                    fontFamily: {
                        display: ["Lexend", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "1rem",
                        lg: "2rem",
                        xl: "3rem",
                        full: "9999px",
                    },
                },
            },
        };
    </script>
</head>
@php
    $settings = app(\App\Settings\GeneralSettings::class);
@endphp

<body
    class="bg-background-light dark:bg-background-dark text-[#121317] font-display overflow-x-hidden flex flex-col min-h-screen">
    @if (app(\App\Settings\GeneralSettings::class)->site_active)
        <nav
            class="sticky top-0 relative z-[100] w-full bg-white/95 backdrop-blur-sm border-b border-[#f1f1f4] shadow-sm">
            <div class="px-4 sm:px-10 lg:px-40 py-4 flex items-center justify-between max-w-[1440px] mx-auto">

                @php
                    $settings = app(\App\Settings\GeneralSettings::class);
                @endphp

                <a class="flex items-center gap-3 group" href="/">
                    @if ($settings->site_logo)
                        <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Logo Aplikasi"
                            class="h-10 w-auto object-contain">
                    @else
                        <div
                            class="size-10 bg-primary/10 rounded-full flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-2xl">school</span>
                        </div>
                    @endif

                    <h2 class="text-primary text-xl font-bold tracking-tight">
                        {{ $settings->site_name }}
                    </h2>
                </a>

                <div class="flex items-center gap-4">
                    <a href="/admin" title="Login Admin"
                        class="flex items-center justify-center w-10 h-10 rounded-full bg-slate-50 text-slate-600 border border-slate-100 hover:bg-white hover:text-primary hover:shadow-md transition-all duration-300">
                        <span class="material-symbols-outlined text-[20px]">login</span>
                    </a>
                </div>
            </div>
        </nav>

        @yield('content')
        <!-- Footer -->
        <footer class="bg-[#1e293b] text-slate-300 py-10">
            <div class="max-w-[1440px] mx-auto px-4 sm:px-10 lg:px-40">

                <div class="flex flex-col md:flex-row justify-between gap-8 mb-8">

                    <div class="max-w-md"> @php
                        $settings = app(\App\Settings\GeneralSettings::class);
                    @endphp

                        <a class="flex items-center gap-3 group mb-4" href="/">
                            @if ($settings->site_logo)
                                <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Logo Aplikasi"
                                    class="h-10 w-auto object-contain hover:scale-105 transition-transform duration-300">
                            @else
                                <span class="material-symbols-outlined text-3xl text-white">school</span>
                            @endif

                            <span class="font-bold text-xl text-white">{{ $settings->site_name }}</span>
                        </a>

                        <p class="text-sm leading-relaxed text-slate-400">
                            {{ $settings->footer_text }}
                        </p>
                    </div>

                    <div>
                        <h4 class="text-white font-bold mb-4">Kontak</h4>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-slate-400 text-[20px]">location_on</span>
                                <span>{{ $settings->site_address }}</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-slate-400 text-[20px]">mail</span>
                                <a href="mailto:{{ $settings->site_email }}"
                                    class="hover:text-white transition-colors">{{ $settings->site_email }}</a>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-slate-400 text-[20px]">call</span>

                                @php
                                    // 1. Ambil nomor asli dari database
                                    $phoneRaw = $settings->site_phone;

                                    // 2. Hapus semua karakter selain angka (spasi, strip, kurung, +)
                                    $phoneClean = preg_replace('/[^0-9]/', '', $phoneRaw);

                                    // 3. Jika diawali angka '0', ganti dengan '62' (Kode Negara Indonesia)
                                    if (substr($phoneClean, 0, 1) == '0') {
                                        $phoneClean = '62' . substr($phoneClean, 1);
                                    }
                                @endphp

                                <a href="https://wa.me/{{ $phoneClean }}" target="_blank"
                                    class="hover:text-white transition-colors">
                                    {{ $settings->site_phone }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-slate-700 pt-6">
                    <p class="text-sm text-slate-500">
                        {{ $settings->site_footer ?? 'Copyright © 2026 Universitas Konoha' }}
                    </p>
                </div>

            </div>
        </footer>
    @else
        <div class="h-screen w-full flex flex-col items-center justify-center bg-gray-100">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Sedang Dalam Perbaikan</h1>
            <p class="text-gray-600">Mohon maaf, website sedang kami update. Silakan kembali lagi nanti.</p>
        </div>

    @endif
</body>

</html>
