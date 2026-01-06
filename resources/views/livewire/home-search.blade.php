<div>
    <section
        class="relative w-full min-h-[560px] flex items-center justify-center bg-cover bg-center bg-no-repeat overflow-hidden px-4"
        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuATiGqGS0MEyzxlKzZrHaBrXZLCJQkBm9ewsnp2CXyWutFuYsR2C1eZCCQBAxjUqo-WN3s9TkR2dxBilCFAQ_cKC_90omq7jJ0XXIAWxlmJVvRt1uHDmm6Gh7OeihXpN5jwkFSCyLvZ6rySZCgX9GkhRK7m544FfXZxq5Z9-4_E7IQxVcjxPbU5ckkn761LCkNO_Lu6YClU77NPPW5UBBSHbw8trvA24fUpdFeaJFf_YUr0f98EM_NR0WR-hgx37nS_s6HkPvpvC-E');">

        <div class="absolute inset-0 bg-primary/85 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

        <div class="relative z-10 w-full max-w-4xl flex flex-col items-center text-center gap-8 py-12">
            <div class="space-y-4 animate-fade-in-up">
                <h1 class="text-white text-4xl md:text-6xl font-black leading-tight tracking-tight drop-shadow-sm">
                    Pusat Pengetahuan & <br class="hidden md:block" />
                    Karya Ilmiah
                </h1>
                <h2 class="text-blue-100 text-lg md:text-xl font-normal max-w-2xl mx-auto leading-relaxed">
                    Temukan ribuan karya ilmiah, skripsi, tesis, dan jurnal dari seluruh
                    civitas akademika Universitas Konoha dalam satu genggaman.
                </h2>
            </div>

            <div class="w-full max-w-2xl mt-4">
                <div
                    class="bg-white rounded-full p-2 shadow-2xl flex items-center ring-1 ring-white/20 focus-within:ring-4 focus-within:ring-accent/30 transition-all duration-300 relative">
                    <div class="pl-4 pr-2 text-slate-400">
                        <span class="material-symbols-outlined text-[24px]">search</span>
                    </div>

                    <input wire:model.live.debounce.300ms="search"
                        class="flex-1 bg-transparent border-none outline-none focus:ring-0 text-slate-700 placeholder:text-slate-400 text-base md:text-lg w-full py-2"
                        placeholder="Cari judul, penulis, atau kata kunci..." type="text" />

                    <div wire:loading wire:target="search" class="absolute right-32 text-primary">
                        <span class="animate-spin material-symbols-outlined">sync</span>
                    </div>

                    <button type="button"
                        class="bg-accent hover:bg-[#d97706] text-white rounded-full h-12 px-8 font-bold text-base shadow-lg hover:shadow-xl transition-all duration-300 flex items-center gap-2">
                        <span>Cari</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <main class="grow w-full max-w-[1440px] mx-auto px-4 sm:px-10 lg:px-40 py-16" id="koleksi">

        <div wire:loading.flex wire:target="setCategory, resetFilters, gotoPage, nextPage, previousPage"
            class="fixed inset-0 bg-black/10 z-50 justify-center items-center backdrop-blur-[1px]">
            <div class="bg-white px-6 py-3 rounded-full shadow-xl flex items-center gap-3">
                <span class="animate-spin material-symbols-outlined text-primary">sync</span>
                <span class="font-bold text-slate-700">Memuat Data...</span>
            </div>
        </div>

        <div class="flex flex-wrap justify-between items-end mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-slate-900 mb-2">
                    @if ($search)
                        Hasil Pencarian: "{{ $search }}"
                    @elseif($activeCategory)
                        Kategori: <span class="text-primary">{{ $activeCategory }}</span>
                    @else
                        Dokumen Terbaru
                    @endif
                </h2>
                <p class="text-slate-500">
                    {{ $activeCategory ? 'Menampilkan dokumen dalam kategori ini.' : 'Koleksi penelitian terbaru yang baru saja ditambahkan.' }}
                </p>
            </div>

            <div class="relative group z-40">
                <button
                    class="flex items-center gap-2 bg-white border border-slate-200 text-primary font-bold py-2.5 px-5 rounded-full shadow-sm hover:shadow-md hover:bg-slate-50 transition-all duration-300">
                    <span>{{ $activeCategory ?? 'Jelajahi Kategori' }}</span>
                    <span
                        class="material-symbols-outlined text-[20px] group-hover:rotate-180 transition-transform duration-300">
                        keyboard_arrow_down
                    </span>
                </button>

                <div class="absolute right-0 top-full pt-4 w-56 hidden group-hover:block z-50">
                    <div
                        class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden animate-fade-in-up">
                        <div class="p-2 border-b border-slate-50">
                            <button wire:click="resetFilters"
                                class="w-full text-left block px-4 py-2 text-sm font-bold text-primary rounded-xl hover:bg-blue-50 transition-colors">
                                Lihat Semua Dokumen
                            </button>
                        </div>

                        <div class="p-2 max-h-64 overflow-y-auto custom-scrollbar">
                            @foreach ($categories as $cat)
                                <button wire:click="setCategory('{{ $cat->name }}')"
                                    class="w-full text-left flex items-center justify-between px-4 py-2 text-sm text-slate-600 rounded-xl hover:bg-slate-50 hover:text-primary transition-colors">
                                    <span>{{ $cat->name }}</span>
                                    @if ($activeCategory === $cat->name)
                                        <span class="material-symbols-outlined text-[16px]">check</span>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($dokumens->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach ($dokumens as $item)
                    <div
                        class="group bg-white rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.05)] hover:shadow-[0_12px_24px_rgba(0,0,0,0.1)] border border-slate-100 hover:border-primary/20 transition-all duration-300 hover:-translate-y-1 flex flex-col overflow-hidden">
                        <div class="h-2 bg-primary w-full"></div>
                        <div class="p-6 flex flex-col flex-1 gap-4">
                            <div class="flex justify-between items-start">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-primary border border-blue-100">
                                    {{ $item->category->name }}
                                </span>
                                <span
                                    class="material-symbols-outlined text-slate-300 group-hover:text-primary transition-colors">description</span>
                            </div>
                            <h3
                                class="text-lg font-bold text-slate-800 leading-snug group-hover:text-primary transition-colors line-clamp-2">
                                <a href="{{ route('dokumen.show', $item->slug) }}">
                                    {{ $item->title }}
                                </a>
                            </h3>
                            <div class="mt-auto space-y-3">
                                <div class="flex items-center gap-2 text-sm text-slate-500 font-medium">
                                    <span class="material-symbols-outlined text-[18px]">person</span>
                                    <span class="truncate">{{ $item->author }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-slate-500 font-medium">
                                    <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                    <span>{{ $item->year }}</span>
                                </div>
                            </div>
                            <div class="pt-4 mt-2 border-t border-slate-50 flex items-center justify-between">
                                <span
                                    class="text-xs text-slate-400 truncate max-w-[150px]">{{ $item->institution }}</span>
                                <a class="shrink-0 whitespace-nowrap text-sm font-bold text-primary hover:text-accent flex items-center gap-1"
                                    href="{{ route('dokumen.show', $item->slug) }}">
                                    Lihat Detail
                                    <span class="material-symbols-outlined text-[16px]">arrow_outward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $dokumens->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-slate-50/50 rounded-3xl border border-slate-100 border-dashed">
                <div class="inline-flex bg-white p-4 rounded-full mb-4 shadow-sm">
                    <span class="material-symbols-outlined text-4xl text-slate-400">search_off</span>
                </div>
                <h3 class="text-xl font-bold text-slate-700">Tidak ada dokumen ditemukan</h3>
                <p class="text-slate-500 mt-2">Coba gunakan kata kunci lain atau reset filter.</p>
                <button wire:click="resetFilters" class="mt-4 text-primary font-bold hover:underline cursor-pointer">
                    Reset Pencarian
                </button>
            </div>
        @endif
    </main>
</div>
