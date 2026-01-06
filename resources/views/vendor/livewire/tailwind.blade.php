<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-8">
            <div class="flex flex-wrap items-center gap-2 p-2 bg-white/50 backdrop-blur-sm rounded-full border border-slate-100 shadow-sm">
                
                {{-- Tombol Previous (<<) --}}
                @if ($paginator->onFirstPage())
                    <span class="flex items-center justify-center w-10 h-10 rounded-full bg-slate-50 text-slate-300 cursor-not-allowed border border-slate-100">
                        <span class="material-symbols-outlined text-lg">chevron_left</span>
                    </span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" type="button" 
                        class="flex items-center justify-center w-10 h-10 rounded-full bg-white text-slate-600 hover:bg-blue-50 hover:text-primary hover:border-blue-200 border border-slate-200 transition-all duration-300 shadow-sm group">
                        <span class="material-symbols-outlined text-lg group-hover:-translate-x-0.5 transition-transform">chevron_left</span>
                    </button>
                @endif

                {{-- Nomor Halaman --}}
                <div class="hidden md:flex gap-2">
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span class="flex items-center justify-center w-10 h-10 text-slate-400 font-bold">
                                {{ $element }}
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    {{-- Halaman Aktif (Warna Biru Primary) --}}
                                    <span aria-current="page">
                                        <span class="flex items-center justify-center w-10 h-10 rounded-full bg-primary text-white font-bold shadow-md shadow-blue-200 border border-primary transform scale-105">
                                            {{ $page }}
                                        </span>
                                    </span>
                                @else
                                    {{-- Halaman Tidak Aktif --}}
                                    <button wire:click="gotoPage({{ $page }})" type="button" 
                                        class="flex items-center justify-center w-10 h-10 rounded-full bg-white text-slate-600 font-medium hover:bg-blue-50 hover:text-primary border border-transparent hover:border-blue-100 transition-all duration-300">
                                        {{ $page }}
                                    </button>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>

                {{-- Tampilan Mobile (Hanya teks "Halaman X dari Y") --}}
                <div class="flex md:hidden items-center px-4 text-sm font-medium text-slate-500">
                    Halaman {{ $paginator->currentPage() }}
                </div>

                {{-- Tombol Next (>>) --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" wire:loading.attr="disabled" type="button" 
                        class="flex items-center justify-center w-10 h-10 rounded-full bg-white text-slate-600 hover:bg-blue-50 hover:text-primary hover:border-blue-200 border border-slate-200 transition-all duration-300 shadow-sm group">
                        <span class="material-symbols-outlined text-lg group-hover:translate-x-0.5 transition-transform">chevron_right</span>
                    </button>
                @else
                    <span class="flex items-center justify-center w-10 h-10 rounded-full bg-slate-50 text-slate-300 cursor-not-allowed border border-slate-100">
                        <span class="material-symbols-outlined text-lg">chevron_right</span>
                    </span>
                @endif
            </div>
        </nav>
    @endif
</div>