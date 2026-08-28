@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navigasi Halaman" class="flex items-center justify-center">
        <div class="inline-flex flex-wrap items-center gap-2 p-2 bg-white border-3 border-black rounded-2xl shadow-brutal">
            {{-- Tombol Previous (<<) --}}
            @if ($paginator->onFirstPage())
                <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-neutral-100 text-neutral-400 border-2 border-neutral-300 cursor-not-allowed select-none">
                    <span class="material-symbols-outlined text-xl">chevron_left</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Halaman Sebelumnya"
                    class="flex items-center justify-center w-10 h-10 rounded-xl bg-white text-black font-extrabold hover:bg-saweria border-2 border-black shadow-brutal-sm hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                    <span class="material-symbols-outlined text-xl font-bold">chevron_left</span>
                </a>
            @endif

            {{-- Nomor Halaman --}}
            <div class="flex items-center gap-1.5 sm:gap-2">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="flex items-center justify-center w-8 h-10 text-black font-black text-sm">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                {{-- Halaman Aktif (Kuning Saweria + Font Hitam Tebal) --}}
                                <span aria-current="page">
                                    <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-saweria text-black font-black text-sm sm:text-base border-2 border-black shadow-brutal-sm">
                                        {{ $page }}
                                    </span>
                                </span>
                            @else
                                {{-- Halaman Tidak Aktif --}}
                                <a href="{{ $url }}"
                                    class="flex items-center justify-center w-10 h-10 rounded-xl bg-white text-black font-extrabold text-sm sm:text-base hover:bg-neutral-100 border-2 border-black shadow-brutal-sm hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Tombol Next (>>) --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Halaman Berikutnya"
                    class="flex items-center justify-center w-10 h-10 rounded-xl bg-white text-black font-extrabold hover:bg-saweria border-2 border-black shadow-brutal-sm hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                    <span class="material-symbols-outlined text-xl font-bold">chevron_right</span>
                </a>
            @else
                <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-neutral-100 text-neutral-400 border-2 border-neutral-300 cursor-not-allowed select-none">
                    <span class="material-symbols-outlined text-xl">chevron_right</span>
                </span>
            @endif
        </div>
    </nav>
@endif
