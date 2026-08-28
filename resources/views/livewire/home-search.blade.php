<div>
    <!-- Hero Section with Retro Dot Pattern -->
    <section class="relative w-full py-12 md:py-20 pattern-dots border-b-4 border-black bg-[#FAF7EE] overflow-hidden">
        <!-- Floating Retro Badges (Hidden on mobile) -->
        <div class="hidden lg:block absolute top-8 left-12 -rotate-6 animate-bounce" style="animation-duration: 3s;">
            <span class="px-4 py-2 bg-pinkpop text-black text-xs font-black uppercase border-2 border-black rounded-xl shadow-brutal-sm inline-flex items-center gap-1.5">
                <span>⚡</span>
                <span>Open Access</span>
            </span>
        </div>
        <div class="hidden lg:block absolute top-14 right-16 rotate-6 animate-bounce" style="animation-duration: 4s;">
            <span class="px-4 py-2 bg-mint text-black text-xs font-black uppercase border-2 border-black rounded-xl shadow-brutal-sm inline-flex items-center gap-1.5">
                <span>📚</span>
                <span>Skripsi &amp; Jurnal</span>
            </span>
        </div>
        <div class="hidden lg:block absolute bottom-8 left-20 rotate-3">
            <span class="px-3.5 py-1.5 bg-lavender text-black text-xs font-black uppercase border-2 border-black rounded-xl shadow-brutal-sm inline-flex items-center gap-1">
                <span>✨</span>
                <span>Terverifikasi</span>
            </span>
        </div>
        <div class="hidden lg:block absolute bottom-10 right-24 -rotate-3">
            <span class="px-3.5 py-1.5 bg-sky text-black text-xs font-black uppercase border-2 border-black rounded-xl shadow-brutal-sm inline-flex items-center gap-1">
                <span>🔥</span>
                <span>Format PDF</span>
            </span>
        </div>

        <div class="relative z-10 w-full max-w-5xl mx-auto px-4 sm:px-8 flex flex-col items-center text-center gap-6">
            <!-- Badge Header -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white border-2 border-black rounded-full shadow-brutal-sm">
                <span class="size-2.5 bg-saweria rounded-full border border-black animate-ping"></span>
                <span class="text-xs font-black uppercase tracking-wider text-black">Digital Knowledge Hub</span>
            </div>

            <!-- Main Headline -->
            <h1 class="text-3xl sm:text-5xl md:text-6xl font-black text-black tracking-tight leading-[1.15] max-w-3xl">
                Pusat Pengetahuan &amp; <br class="hidden sm:block">
                <span class="relative inline-block mt-1">
                    <span class="relative z-10 px-4 py-1.5 bg-saweria text-black border-3 border-black shadow-brutal-md rounded-2xl inline-block -rotate-1 hover:rotate-0 transition-transform">
                        Karya Ilmiah
                    </span>
                </span>
            </h1>

            <p class="text-neutral-700 font-semibold text-sm sm:text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
                Jelajahi dan unduh ribuan skripsi, tesis, laporan penelitian, dan jurnal akademik secara terbuka dalam satu platform.
            </p>

            <!-- Chunky Neobrutalist Search Bar -->
            <div class="w-full max-w-2xl mt-4">
                <div class="bg-white border-4 border-black rounded-2xl p-2 sm:p-2.5 shadow-brutal-lg flex items-center gap-2 relative">
                    <div class="pl-2 sm:pl-3 text-black">
                        <span class="material-symbols-outlined text-2xl font-bold">search</span>
                    </div>

                    <input wire:model.live.debounce.300ms="search"
                        class="flex-1 bg-transparent border-none outline-none focus:ring-0 text-black placeholder:text-neutral-400 font-bold text-sm sm:text-base w-full py-2"
                        placeholder="Ketik judul, penulis, atau kata kunci dokumen..." type="text" />

                    <!-- Realtime Loading Indicator -->
                    <div wire:loading wire:target="search" class="text-black pr-2">
                        <span class="animate-spin material-symbols-outlined text-xl font-bold">sync</span>
                    </div>

                    <button type="button"
                        class="bg-saweria hover:bg-saweria-hover text-black font-black text-xs sm:text-sm uppercase px-5 sm:px-7 py-3 border-2 border-black rounded-xl shadow-brutal-sm hover:-translate-y-0.5 hover:shadow-brutal active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center gap-1.5 cursor-pointer">
                        <span>Cari</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </div>

                <!-- Quick Keywords helper -->
                <div class="mt-3 flex flex-wrap items-center justify-center gap-2 text-xs font-bold text-neutral-600">
                    <span class="text-neutral-500">Pencarian Populer:</span>
                    <button wire:click="$set('search', 'Sistem Informasi')" class="px-2.5 py-1 bg-white hover:bg-saweria border border-black rounded-md shadow-[1px_1px_0px_#000] transition-colors cursor-pointer">Sistem Informasi</button>
                    <button wire:click="$set('search', 'Machine Learning')" class="px-2.5 py-1 bg-white hover:bg-mint border border-black rounded-md shadow-[1px_1px_0px_#000] transition-colors cursor-pointer">Machine Learning</button>
                    <button wire:click="$set('search', 'Manajemen')" class="px-2.5 py-1 bg-white hover:bg-lavender border border-black rounded-md shadow-[1px_1px_0px_#000] transition-colors cursor-pointer">Manajemen</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <main class="grow w-full max-w-[1440px] mx-auto px-4 sm:px-8 lg:px-16 py-12" id="koleksi">

        <!-- Global Livewire Loading Overlay -->
        <div wire:loading.flex wire:target="setCategory, resetFilters, gotoPage, nextPage, previousPage"
            class="fixed inset-0 bg-black/20 z-[150] justify-center items-center backdrop-blur-[2px]">
            <div class="bg-white px-6 py-4 rounded-2xl border-3 border-black shadow-brutal-lg flex items-center gap-3 animate-bounce">
                <span class="animate-spin material-symbols-outlined text-2xl font-bold text-black">sync</span>
                <span class="font-black text-black text-sm uppercase tracking-wider">Memuat Dokumen... ⚡</span>
            </div>
        </div>

        <!-- Section Header & Filter Bar -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-10 pb-6 border-b-3 border-black">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="size-3 bg-saweria rounded-full border border-black inline-block"></span>
                    <span class="text-xs font-black uppercase tracking-wider text-neutral-600">Daftar Repositori</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-black text-black tracking-tight">
                    @if ($search)
                        Hasil Pencarian: <span class="bg-saweria px-2 py-0.5 border-2 border-black rounded-lg">"{{ $search }}"</span>
                    @elseif($activeCategory)
                        Kategori: <span class="bg-mint px-2 py-0.5 border-2 border-black rounded-lg">{{ $activeCategory }}</span>
                    @else
                        Semua Koleksi Dokumen
                    @endif
                </h2>
                <p class="text-xs sm:text-sm font-semibold text-neutral-600 mt-1">
                    {{ $activeCategory ? 'Menampilkan dokumen khusus dalam kategori yang dipilih.' : 'Arsip penelitian dan publikasi akademik terbaru yang siap diunduh.' }}
                </p>
            </div>

            <!-- Neobrutalist Category Chips -->
            <div class="flex flex-wrap items-center gap-2">
                <button wire:click="resetFilters"
                    class="px-4 py-2 text-xs font-black rounded-xl border-2 border-black transition-all cursor-pointer {{ is_null($activeCategory) && empty($search) ? 'bg-black text-white shadow-brutal-sm' : 'bg-white text-dark shadow-brutal-sm hover:-translate-y-0.5 hover:bg-neutral-50' }}">
                    ✦ Semua ({{ $categories->count() }})
                </button>

                @foreach ($categories as $index => $cat)
                    @php
                        // Cycle through fun pastel colors for badges
                        $colors = ['bg-saweria', 'bg-mint', 'bg-pinkpop', 'bg-sky', 'bg-lavender', 'bg-peach'];
                        $chipColor = $colors[$index % count($colors)];
                        $isActive = $activeCategory === $cat->name;
                    @endphp
                    <button wire:click="setCategory('{{ $cat->name }}')"
                        class="px-3.5 py-2 text-xs font-black rounded-xl border-2 border-black transition-all cursor-pointer flex items-center gap-1.5 {{ $isActive ? 'bg-black text-white shadow-brutal-sm scale-105' : $chipColor . ' text-black shadow-brutal-sm hover:-translate-y-0.5' }}">
                        <span>{{ $cat->name }}</span>
                        @if ($isActive)
                            <span class="material-symbols-outlined text-[14px]">check</span>
                        @endif
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Active Filter Indicator Bar (If Filter/Search is active) -->
        @if ($search || $activeCategory)
            <div class="mb-8 p-4 bg-white border-3 border-black rounded-2xl shadow-brutal-sm flex items-center justify-between gap-4">
                <div class="flex items-center gap-2 flex-wrap text-xs font-bold">
                    <span class="text-neutral-500">Filter Aktif:</span>
                    @if ($search)
                        <span class="px-2.5 py-1 bg-saweria text-black border-2 border-black rounded-lg flex items-center gap-1">
                            Kata Kunci: <strong>{{ $search }}</strong>
                        </span>
                    @endif
                    @if ($activeCategory)
                        <span class="px-2.5 py-1 bg-mint text-black border-2 border-black rounded-lg flex items-center gap-1">
                            Kategori: <strong>{{ $activeCategory }}</strong>
                        </span>
                    @endif
                </div>
                <button wire:click="resetFilters" class="shrink-0 px-3 py-1.5 bg-coral text-white text-xs font-black rounded-lg border-2 border-black shadow-brutal-sm hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 transition-all cursor-pointer">
                    ✕ Reset Filter
                </button>
            </div>
        @endif

        <!-- Document Grid -->
        @if ($dokumens->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach ($dokumens as $index => $item)
                    @php
                        $badgeColors = ['bg-saweria', 'bg-mint', 'bg-sky', 'bg-lavender', 'bg-pinkpop', 'bg-peach'];
                        $cardBadgeColor = $badgeColors[$index % count($badgeColors)];
                    @endphp
                    <div class="card-brutal bg-white border-3 border-black rounded-2xl shadow-brutal-md p-6 flex flex-col justify-between group">
                        <div class="space-y-4">
                            <!-- Header Meta -->
                            <div class="flex items-center justify-between gap-2">
                                <span class="inline-flex items-center px-3 py-1 {{ $cardBadgeColor }} text-black text-xs font-black uppercase rounded-lg border-2 border-black shadow-brutal-sm tracking-wide whitespace-nowrap">
                                    {{ $item->category->name ?? 'Dokumen' }}
                                </span>
                                
                                <span class="px-2.5 py-0.5 bg-[#FAF7EE] text-black text-xs font-black rounded-md border-2 border-black flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">calendar_month</span>
                                    <span>{{ $item->year }}</span>
                                </span>
                            </div>

                            <!-- Document Title -->
                            <h3 class="text-lg font-black text-black leading-snug group-hover:text-black line-clamp-2">
                                <a href="{{ route('dokumen.show', $item->slug) }}" class="hover:underline decoration-saweria decoration-4">
                                    {{ $item->title }}
                                </a>
                            </h3>

                            <!-- Abstract Snippet -->
                            <p class="text-xs sm:text-sm font-semibold text-neutral-600 line-clamp-3 leading-relaxed">
                                {{ strip_tags($item->abstract) }}
                            </p>

                            <!-- Author & Institution Pills -->
                            <div class="space-y-2 pt-2">
                                <div class="flex items-center gap-2 p-2 bg-[#FAF7EE] border border-black rounded-xl text-xs font-bold text-neutral-800">
                                    <span class="material-symbols-outlined text-[16px] text-coral">person</span>
                                    <span class="truncate">{{ $item->author }}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-[#FAF7EE] border border-black rounded-xl text-xs font-bold text-neutral-800">
                                    <span class="material-symbols-outlined text-[16px] text-sky">school</span>
                                    <span class="truncate">{{ $item->institution }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Action Footer -->
                        <div class="pt-5 mt-5 border-t-2 border-black flex items-center justify-between gap-3">
                            <span class="inline-flex items-center gap-1 text-[11px] font-extrabold text-neutral-600">
                                <span class="material-symbols-outlined text-[16px]">download</span>
                                <span>{{ $item->downloads ?? 0 }} Unduhan</span>
                            </span>

                            <a href="{{ route('dokumen.show', $item->slug) }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-saweria hover:bg-saweria-hover text-black text-xs font-black uppercase rounded-xl border-2 border-black shadow-brutal-sm hover:-translate-y-0.5 hover:shadow-brutal active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                                <span>Buka Dokumen</span>
                                <span class="material-symbols-outlined text-[16px]">arrow_outward</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Neobrutalist Custom Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $dokumens->links() }}
            </div>
        @else
            <!-- Neobrutalist Empty Search State -->
            <div class="text-center py-16 px-6 bg-white border-3 border-black rounded-3xl shadow-brutal-lg max-w-lg mx-auto space-y-4">
                <div class="size-16 bg-coral border-3 border-black rounded-2xl shadow-brutal mx-auto flex items-center justify-center text-3xl">
                    🔍
                </div>
                <div class="space-y-1">
                    <h3 class="text-xl font-black text-black">Dokumen Tidak Ditemukan</h3>
                    <p class="text-xs sm:text-sm font-semibold text-neutral-600 max-w-sm mx-auto">
                        Tidak ada dokumen yang cocok dengan kata kunci atau filter yang Anda pilih.
                    </p>
                </div>
                <button wire:click="resetFilters"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-saweria text-black font-black text-xs uppercase rounded-xl border-2 border-black shadow-brutal hover:-translate-y-0.5 hover:shadow-brutal-md active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                    <span class="material-symbols-outlined text-[18px]">restart_alt</span>
                    <span>Reset Semua Pencarian</span>
                </button>
            </div>
        @endif
    </main>
</div>
