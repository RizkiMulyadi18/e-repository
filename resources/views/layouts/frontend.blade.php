<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Repository - Universitas Malikussaleh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <svg class="w-8 h-8 text-blue-800 group-hover:text-blue-600 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.747 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span class="font-bold text-xl text-blue-900 tracking-tight group-hover:text-blue-700 transition">
                        E-Repository <span class="font-light">Unimal</span>
                    </span>
                </a>

                <div>
                    <a href="/admin"
                        class="inline-flex items-center px-4 py-2 border border-blue-600 text-sm font-medium rounded-lg text-blue-600 bg-white hover:bg-blue-50 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Login Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="mt-auto bg-gradient-to-b from-slate-900 to-slate-950 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 py-10 sm:grid-cols-2 sm:items-start">
                {{-- Kiri: Brand --}}
                <div class="text-left">
                    <h3 class="text-xl font-semibold tracking-tight">E-Repository Unimal</h3>

                    <p class="mt-3 max-w-md text-sm leading-relaxed text-slate-300">
                        Platform arsip karya ilmiah mahasiswa dan dosen.<br>
                        Mudah dicari, rapi disimpan, cepat diakses.
                    </p>

                    <div
                        class="mt-5 inline-flex items-center gap-2 rounded-full bg-white/5 px-3 py-1 text-xs text-slate-300">
                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                        <span>Online</span>
                        <span class="text-slate-500">•</span>
                        <span>Terbaru setiap hari</span>
                    </div>
                </div>

                {{-- Kanan: Kontak --}}
                <div class="text-left">
                    <h3 class="text-sm font-semibold text-white/90">Kontak Pengelola</h3>

                    <p class="mt-3 max-w-md text-sm leading-relaxed text-slate-300">
                        Menyediakan informasi kontak pengelola repositori untuk pertanyaan atau permintaan data.
                    </p>

                    <dl class="mt-5 space-y-3 text-sm">
                        <div class="grid grid-cols-[72px_1fr] items-start gap-3">
                            <dt class="text-slate-400">Email</dt>
                            <dd>
                                <a href="mailto:repo@unimal.ac.id" class="text-slate-200 hover:text-white">
                                    repo@unimal.ac.id
                                </a>
                            </dd>
                        </div>

                        <div class="grid grid-cols-[72px_1fr] items-start gap-3">
                            <dt class="text-slate-400">WA</dt>
                            <dd>
                                <a href="https://wa.me/6281265409598?text=Halo%20Admin%20E-Repository%2C%20saya%20ingin%20bertanya..."
                                    target="_blank" rel="noopener" class="text-slate-200 hover:text-white">
                                    +62 812-6540-9598
                                </a>
                            </dd>
                        </div>

                        <div class="grid grid-cols-[72px_1fr] items-start gap-3">
                            <dt class="text-slate-400">Alamat</dt>
                            <dd class="text-slate-200">
                                FEB Universitas Malikussaleh<br>
                                Aceh Utara, Indonesia
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- Garis + Copyright --}}
            <div class="border-t border-white/10 py-5 text-center text-xs text-slate-400">
                © {{ date('Y') }} Universitas Malikussaleh. All rights reserved.
            </div>
        </div>
    </footer>
</body>

</html>
