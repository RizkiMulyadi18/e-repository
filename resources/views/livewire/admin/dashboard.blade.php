<div>
    @section('title', 'Dashboard')
    @section('header', 'Dashboard Utama')

    <!-- Welcome Hero Banner -->
    <div class="mb-8 p-6 sm:p-8 bg-saweria border-4 border-black rounded-3xl shadow-brutal-lg flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative overflow-hidden">
        <div class="space-y-2 relative z-10">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-black text-saweria text-xs font-black uppercase rounded-lg border border-black">
                <span>✦</span>
                <span>Selamat Datang</span>
            </div>
            <h2 class="text-2xl sm:text-4xl font-black text-black tracking-tight">
                Halo, {{ auth()->user()->name }}! 👋
            </h2>
            <p class="text-xs sm:text-sm font-bold text-neutral-800 max-w-xl">
                Kelola repositori dokumen karya ilmiah, skripsi, dan jurnal akademik secara terpusat dengan cepat dan efisien.
            </p>
        </div>

        <div class="flex flex-wrap gap-2.5 relative z-10">
            <a href="{{ route('admin.dokumens') }}"
                class="px-4 py-2.5 bg-white hover:bg-neutral-50 text-black text-xs font-black uppercase rounded-xl border-2 border-black shadow-brutal-sm hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[18px]">add_circle</span>
                <span>Upload Dokumen</span>
            </a>
            <a href="{{ route('admin.laporan.cetak') }}" target="_blank"
                class="px-4 py-2.5 bg-black hover:bg-neutral-800 text-white text-xs font-black uppercase rounded-xl border-2 border-black shadow-brutal-sm hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[18px]">print</span>
                <span>Cetak Rekap</span>
            </a>
        </div>
    </div>

    <!-- Stat Overview Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">
        
        <!-- Stat 1: Total Dokumen -->
        <div class="p-5 bg-white border-3 border-black rounded-2xl shadow-brutal-md hover:-translate-y-1 hover:shadow-brutal-lg transition-all space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-black uppercase text-neutral-600 tracking-wider">Total Dokumen</span>
                <div class="size-9 bg-sky rounded-xl border-2 border-black flex items-center justify-center font-bold shadow-brutal-sm">
                    <span class="material-symbols-outlined text-lg">description</span>
                </div>
            </div>
            <div class="text-3xl sm:text-4xl font-black text-black">{{ $totalDokumen }}</div>
            <div class="text-[11px] font-bold text-neutral-500 flex items-center gap-1">
                <span>📚</span>
                <span>Seluruh karya ilmiah</span>
            </div>
        </div>

        <!-- Stat 2: Perlu Review (Draft) -->
        <div class="p-5 bg-white border-3 border-black rounded-2xl shadow-brutal-md hover:-translate-y-1 hover:shadow-brutal-lg transition-all space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-black uppercase text-neutral-600 tracking-wider">Perlu Review</span>
                <div class="size-9 bg-coral rounded-xl border-2 border-black text-white flex items-center justify-center font-bold shadow-brutal-sm">
                    <span class="material-symbols-outlined text-lg">pending_actions</span>
                </div>
            </div>
            <div class="text-3xl sm:text-4xl font-black text-coral">{{ $dokumenDraft }}</div>
            <div class="text-[11px] font-bold text-neutral-500 flex items-center gap-1">
                <span>⏳</span>
                <span>Status Draft</span>
            </div>
        </div>

        <!-- Stat 3: Total Kategori -->
        <div class="p-5 bg-white border-3 border-black rounded-2xl shadow-brutal-md hover:-translate-y-1 hover:shadow-brutal-lg transition-all space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-black uppercase text-neutral-600 tracking-wider">Total Kategori</span>
                <div class="size-9 bg-lavender rounded-xl border-2 border-black flex items-center justify-center font-bold shadow-brutal-sm">
                    <span class="material-symbols-outlined text-lg">category</span>
                </div>
            </div>
            <div class="text-3xl sm:text-4xl font-black text-black">{{ $totalKategori }}</div>
            <div class="text-[11px] font-bold text-neutral-500 flex items-center gap-1">
                <span>🏷️</span>
                <span>Bidang keilmuan</span>
            </div>
        </div>

        <!-- Stat 4: Total Unduhan -->
        <div class="p-5 bg-white border-3 border-black rounded-2xl shadow-brutal-md hover:-translate-y-1 hover:shadow-brutal-lg transition-all space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-black uppercase text-neutral-600 tracking-wider">Total Unduhan</span>
                <div class="size-9 bg-mint rounded-xl border-2 border-black flex items-center justify-center font-bold shadow-brutal-sm">
                    <span class="material-symbols-outlined text-lg">download</span>
                </div>
            </div>
            <div class="text-3xl sm:text-4xl font-black text-black">{{ $totalUnduhan }}</div>
            <div class="text-[11px] font-bold text-neutral-500 flex items-center gap-1">
                <span>⚡</span>
                <span>Akses file PDF</span>
            </div>
        </div>

        <!-- Stat 5: User Terdaftar -->
        <div class="p-5 bg-white border-3 border-black rounded-2xl shadow-brutal-md hover:-translate-y-1 hover:shadow-brutal-lg transition-all space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-black uppercase text-neutral-600 tracking-wider">Pengguna</span>
                <div class="size-9 bg-pinkpop rounded-xl border-2 border-black flex items-center justify-center font-bold shadow-brutal-sm">
                    <span class="material-symbols-outlined text-lg">group</span>
                </div>
            </div>
            <div class="text-3xl sm:text-4xl font-black text-black">{{ $totalUser }}</div>
            <div class="text-[11px] font-bold text-neutral-500 flex items-center gap-1">
                <span>👥</span>
                <span>Admin &amp; Editor</span>
            </div>
        </div>

    </div>

    <!-- Recent Documents Table Section -->
    <div class="bg-white border-3 border-black rounded-3xl shadow-brutal-lg overflow-hidden">
        
        <!-- Table Header -->
        <div class="p-5 sm:p-6 bg-[#FFFDF7] border-b-3 border-black flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <div class="size-3 bg-saweria rounded-full border border-black inline-block"></div>
                    <h3 class="text-lg sm:text-xl font-black text-black tracking-tight">Dokumen Terbaru</h3>
                </div>
                <p class="text-xs font-semibold text-neutral-500 mt-0.5">
                    5 Dokumen terakhir yang diunggah ke dalam sistem.
                </p>
            </div>

            <a href="{{ route('admin.dokumens') }}"
                class="px-4 py-2 bg-white hover:bg-neutral-50 text-black text-xs font-black uppercase rounded-xl border-2 border-black shadow-brutal-sm hover:-translate-y-0.5 transition-all inline-flex items-center gap-1">
                <span>Lihat Semua Dokumen</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#FAF7EE] border-b-2 border-black text-[11px] font-black uppercase text-black tracking-wider">
                        <th class="py-3.5 px-6">Judul Dokumen</th>
                        <th class="py-3.5 px-4">Kategori</th>
                        <th class="py-3.5 px-4">Penulis</th>
                        <th class="py-3.5 px-4">Tahun</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-6 text-right">Aksi Cepat</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-neutral-100 text-xs font-bold text-neutral-800">
                    @forelse ($latestDokumens as $doc)
                        <tr class="hover:bg-[#FFFDF7] transition-colors">
                            <td class="py-4 px-6 min-w-[260px]">
                                <a href="{{ route('dokumen.show', $doc->slug) }}" target="_blank" class="font-black text-black hover:underline text-sm leading-snug block">
                                    {{ $doc->title }}
                                </a>
                                <span class="text-[11px] text-neutral-500 block truncate mt-0.5">{{ $doc->institution }}</span>
                            </td>
                            <td class="py-4 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-1 bg-white border border-black rounded-lg text-[11px] font-black shadow-[1px_1px_0px_#000] whitespace-nowrap">
                                    {{ $doc->category->name ?? '-' }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-neutral-700">
                                {{ $doc->author }}
                            </td>
                            <td class="py-4 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-0.5 bg-neutral-100 border border-black rounded text-[11px] font-bold">
                                    {{ $doc->year }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                @if ($doc->status === 'published')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-mint text-black border border-black rounded-lg text-[11px] font-black shadow-[1px_1px_0px_#000]">
                                        <span>●</span>
                                        <span>Published</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-coral text-white border border-black rounded-lg text-[11px] font-black shadow-[1px_1px_0px_#000]">
                                        <span>○</span>
                                        <span>Draft</span>
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <button wire:click="toggleStatus({{ $doc->id }})"
                                    class="px-3 py-1.5 {{ $doc->status === 'published' ? 'bg-white hover:bg-neutral-100 text-neutral-800' : 'bg-saweria hover:bg-saweria-hover text-black' }} text-[11px] font-black uppercase rounded-lg border-2 border-black shadow-brutal-sm hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                                    {{ $doc->status === 'published' ? 'Jadikan Draft' : '✓ Publikasikan' }}
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-neutral-500 font-bold">
                                Belum ada dokumen yang diunggah.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
