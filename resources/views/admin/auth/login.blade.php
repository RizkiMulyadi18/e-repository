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
    <title>Login Admin — {{ $settings->site_name ?? 'E-Repository' }}</title>

    <!-- Google Fonts: Plus Jakarta Sans & Space Grotesk -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">

    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>

    <!-- Tailwind Configuration -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        cream: "#FAF7EE",
                        saweria: "#FFE600",
                        "saweria-hover": "#F0D800",
                        coral: "#FF6B6B",
                        mint: "#4ECCA3",
                        sky: "#7DD3FC",
                        lavender: "#D8B4FE",
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
    </style>
</head>

<body class="bg-[#FAF7EE] text-dark font-sans min-h-screen flex flex-col justify-center items-center p-4 pattern-dots">

    <!-- Login Card Container -->
    <div class="w-full max-w-md">
        
        <!-- Brand Header Badge -->
        <div class="text-center mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 p-2 bg-white border-3 border-black rounded-2xl shadow-brutal hover:-translate-y-0.5 transition-all">
                @if ($settings->site_logo)
                    <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Logo" class="h-8 w-auto object-contain">
                @else
                    <div class="size-8 bg-saweria rounded-lg border-2 border-black flex items-center justify-center font-bold">
                        <span class="material-symbols-outlined text-lg">menu_book</span>
                    </div>
                @endif
                <span class="font-black text-lg text-black pr-2">{{ $settings->site_name ?? 'E-Repository' }}</span>
            </a>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white border-4 border-black rounded-3xl shadow-brutal-lg p-6 sm:p-8 space-y-6">
            
            <div class="text-center space-y-1">
                <div class="inline-block px-3 py-1 bg-saweria text-black text-xs font-black uppercase rounded-lg border-2 border-black shadow-brutal-sm mb-1">
                    🔒 Administrator &amp; Editor
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-black tracking-tight">Masuk Panel Admin</h1>
                <p class="text-xs sm:text-sm font-semibold text-neutral-600">
                    Silakan masukkan email dan kata sandi Anda.
                </p>
            </div>

            <!-- Error Alerts -->
            @if ($errors->any())
                <div class="p-4 bg-coral/10 border-2 border-coral text-coral rounded-xl text-xs font-bold space-y-1">
                    @foreach ($errors->all() as $error)
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">error</span>
                            <span>{{ $error }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Session Status Alert -->
            @if (session('success'))
                <div class="p-3 bg-mint/20 border-2 border-mint text-emerald-900 rounded-xl text-xs font-bold flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.login') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email Input -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-black uppercase tracking-wider text-black">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-neutral-400">
                            <span class="material-symbols-outlined text-[20px]">mail</span>
                        </div>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                            placeholder="nama@domain.com"
                            class="w-full pl-10 pr-4 py-3 bg-[#FAF7EE] border-2 border-black rounded-xl text-sm font-bold text-black placeholder:text-neutral-400 focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal transition-all" />
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-1.5">
                    <label for="password" class="block text-xs font-black uppercase tracking-wider text-black">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-neutral-400">
                            <span class="material-symbols-outlined text-[20px]">lock</span>
                        </div>
                        <input id="password" name="password" type="password" required
                            placeholder="••••••••"
                            class="w-full pl-10 pr-4 py-3 bg-[#FAF7EE] border-2 border-black rounded-xl text-sm font-bold text-black placeholder:text-neutral-400 focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal transition-all" />
                    </div>
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="size-4 rounded border-2 border-black text-black focus:ring-0 cursor-pointer">
                        <span class="text-xs font-bold text-neutral-700 select-none">Ingat Saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3.5 px-4 bg-saweria hover:bg-saweria-hover text-black font-black text-sm uppercase rounded-xl border-3 border-black shadow-brutal hover:-translate-y-0.5 hover:shadow-brutal-md active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center justify-center gap-2 cursor-pointer">
                    <span>Masuk ke Panel</span>
                    <span class="material-symbols-outlined text-[20px]">login</span>
                </button>
            </form>

            <div class="pt-4 border-t-2 border-black text-center">
                <a href="{{ route('home') }}" class="text-xs font-extrabold text-neutral-600 hover:text-black hover:underline inline-flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                    <span>Kembali ke Halaman Publik</span>
                </a>
            </div>

        </div>

        <!-- Default Credentials Quick Helper for Development -->
        <div class="mt-6 p-4 bg-white border-2 border-black rounded-2xl shadow-brutal-sm text-xs font-medium text-neutral-600 space-y-1">
            <p class="font-extrabold text-black flex items-center gap-1">
                <span>🔑</span>
                <span>Akun Bawaan (Default):</span>
            </p>
            <p>Admin: <strong class="text-black">rizki@gmail.com</strong> / <strong class="text-black">admin123</strong></p>
            <p>Editor: <strong class="text-black">budi@gmail.com</strong> / <strong class="text-black">editor123</strong></p>
        </div>

    </div>

</body>

</html>
