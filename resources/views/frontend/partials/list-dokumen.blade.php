@if ($dokumens->count() > 0)
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($dokumens as $index => $item)
            @php
                $badgeColors = ['bg-saweria', 'bg-mint', 'bg-sky', 'bg-lavender', 'bg-pinkpop', 'bg-peach'];
                $cardBadgeColor = $badgeColors[$index % count($badgeColors)];
            @endphp
            <div class="card-brutal bg-white border-3 border-black rounded-2xl shadow-brutal-md p-6 flex flex-col justify-between group">
                <div class="space-y-4">
                    <!-- Badge & Year -->
                    <div class="flex items-center justify-between gap-2">
                        <span class="inline-flex items-center px-3 py-1 {{ $cardBadgeColor }} text-black text-xs font-black uppercase rounded-lg border-2 border-black shadow-brutal-sm whitespace-nowrap">
                            {{ $item->category->name ?? 'Dokumen' }}
                        </span>
                        <span class="px-2.5 py-0.5 bg-[#FAF7EE] text-black text-xs font-black rounded-md border-2 border-black flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">calendar_month</span>
                            <span>{{ $item->year }}</span>
                        </span>
                    </div>

                    <!-- Title -->
                    <h3 class="text-lg font-black text-black leading-snug line-clamp-2">
                        <a href="{{ route('dokumen.show', $item->slug) }}" class="hover:underline decoration-saweria decoration-4">
                            {{ $item->title }}
                        </a>
                    </h3>

                    <!-- Abstract -->
                    <p class="text-xs sm:text-sm font-semibold text-neutral-600 line-clamp-3 leading-relaxed">
                        {{ strip_tags($item->abstract) }}
                    </p>

                    <!-- Author & Institution -->
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

                <!-- Footer Action -->
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

    <div class="mt-8 flex justify-center">
        {{ $dokumens->withQueryString()->links() }}
    </div>
@else
    <div class="text-center py-16 px-6 bg-white border-3 border-black rounded-3xl shadow-brutal-lg max-w-lg mx-auto space-y-4">
        <div class="size-16 bg-coral border-3 border-black rounded-2xl shadow-brutal mx-auto flex items-center justify-center text-3xl">
            🔍
        </div>
        <h3 class="text-xl font-black text-black">Dokumen Tidak Ditemukan</h3>
        <p class="text-xs sm:text-sm font-semibold text-neutral-600">Coba kata kunci lain atau reset pencarian Anda.</p>
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-saweria text-black font-black text-xs uppercase rounded-xl border-2 border-black shadow-brutal hover:-translate-y-0.5 transition-all">
            Reset Pencarian
        </a>
    </div>
@endif
