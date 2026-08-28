<div>
    @section('title', 'Kelola Dokumen')
    @section('header', 'Manajemen Dokumen')

    <!-- Action & Filter Bar -->
    <div class="mb-6 p-5 sm:p-6 bg-white border-3 border-black rounded-3xl shadow-brutal-md flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
        
        <!-- Left: Search & Filters -->
        <div class="flex flex-col sm:flex-row items-center gap-3 flex-1">
            <!-- Search Input -->
            <div class="relative w-full sm:w-72">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari judul, penulis..."
                    class="w-full pl-10 pr-4 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black placeholder:text-neutral-400 focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm transition-all" />
            </div>

            <!-- Filter Kategori -->
            <select wire:model.live="categoryFilter"
                class="w-full sm:w-48 py-2.5 px-3 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm transition-all cursor-pointer">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

            <!-- Filter Status -->
            <select wire:model.live="statusFilter"
                class="w-full sm:w-40 py-2.5 px-3 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm transition-all cursor-pointer">
                <option value="">Semua Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div>

        <!-- Right: Add Button -->
        <button wire:click="openCreateModal"
            class="px-5 py-2.5 bg-saweria hover:bg-saweria-hover text-black font-black text-xs uppercase rounded-xl border-2 border-black shadow-brutal-sm hover:-translate-y-0.5 hover:shadow-brutal active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center justify-center gap-1.5 cursor-pointer">
            <span class="material-symbols-outlined text-[18px]">add</span>
            <span>Tambah Dokumen</span>
        </button>
    </div>

    <!-- Table Container -->
    <div class="bg-white border-3 border-black rounded-3xl shadow-brutal-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#FAF7EE] border-b-2 border-black text-[11px] font-black uppercase text-black tracking-wider">
                        <th class="py-3.5 px-6">Dokumen</th>
                        <th class="py-3.5 px-4">Kategori</th>
                        <th class="py-3.5 px-4">Penulis &amp; Kampus</th>
                        <th class="py-3.5 px-4">Tahun</th>
                        <th class="py-3.5 px-4">Unduhan</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-neutral-100 text-xs font-bold text-neutral-800">
                    @forelse ($dokumens as $doc)
                        <tr class="hover:bg-[#FFFDF7] transition-colors">
                            <!-- Judul Dokumen (Tampil Penuh) -->
                            <td class="py-4 px-6 min-w-[280px]">
                                <a href="{{ route('dokumen.show', $doc->slug) }}" target="_blank" class="font-black text-black hover:underline text-sm leading-snug block">
                                    {{ $doc->title }}
                                </a>
                            </td>

                            <!-- Kategori -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-1 bg-white border border-black rounded-lg text-[11px] font-black shadow-[1px_1px_0px_#000] whitespace-nowrap">
                                    {{ $doc->category->name ?? '-' }}
                                </span>
                            </td>

                            <!-- Penulis & Institusi -->
                            <td class="py-4 px-4">
                                <div class="font-bold text-black">{{ $doc->author }}</div>
                                <div class="text-[11px] text-neutral-500">{{ $doc->institution }}</div>
                            </td>

                            <!-- Tahun -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-0.5 bg-neutral-100 border border-black rounded text-[11px] font-bold">
                                    {{ $doc->year }}
                                </span>
                            </td>

                            <!-- Unduhan -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 font-black text-black">
                                    <span class="material-symbols-outlined text-[16px] text-mint">download</span>
                                    <span>{{ $doc->downloads ?? 0 }}</span>
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <button wire:click="toggleStatus({{ $doc->id }})" title="Klik untuk ubah status"
                                    class="inline-flex items-center gap-1 px-2.5 py-1 {{ $doc->status === 'published' ? 'bg-mint text-black' : 'bg-coral text-white' }} border border-black rounded-lg text-[11px] font-black shadow-[1px_1px_0px_#000] hover:scale-105 transition-transform cursor-pointer whitespace-nowrap">
                                    <span>{{ $doc->status === 'published' ? '● Published' : '○ Draft' }}</span>
                                </button>
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- Download PDF Link -->
                                    <a href="{{ route('dokumen.download', $doc->slug) }}" target="_blank" title="Unduh PDF"
                                        class="size-8 bg-white hover:bg-sky/20 border-2 border-black rounded-lg flex items-center justify-center shadow-brutal-sm hover:-translate-y-0.5 transition-all text-sky-800">
                                        <span class="material-symbols-outlined text-[16px]">file_download</span>
                                    </a>

                                    <!-- Edit Button -->
                                    <button wire:click="openEditModal({{ $doc->id }})" title="Edit Dokumen"
                                        class="size-8 bg-saweria hover:bg-saweria-hover border-2 border-black rounded-lg flex items-center justify-center shadow-brutal-sm hover:-translate-y-0.5 transition-all text-black cursor-pointer">
                                        <span class="material-symbols-outlined text-[16px]">edit</span>
                                    </button>

                                    <!-- Delete Button -->
                                    <button wire:click="confirmDelete({{ $doc->id }})" title="Hapus Dokumen"
                                        class="size-8 bg-coral hover:bg-red-600 border-2 border-black rounded-lg flex items-center justify-center shadow-brutal-sm hover:-translate-y-0.5 transition-all text-white cursor-pointer">
                                        <span class="material-symbols-outlined text-[16px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-16 text-center text-neutral-500 font-bold">
                                Tidak ada dokumen ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 bg-[#FAF7EE] border-t-2 border-black">
            {{ $dokumens->links() }}
        </div>
    </div>

    <!-- Create / Edit Modal -->
    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white border-4 border-black rounded-3xl shadow-brutal-xl w-full max-w-2xl overflow-hidden animate-fade-in-up my-4 sm:my-8 flex flex-col max-h-[90vh]">
                
                <!-- Modal Header (Fixed) -->
                <div class="p-5 sm:p-6 bg-[#FFFDF7] border-b-3 border-black flex items-center justify-between shrink-0">
                    <div class="flex items-center gap-2">
                        <span class="size-3 bg-saweria rounded-full border border-black"></span>
                        <h3 class="text-lg font-black text-black">
                            {{ $dokumenId ? 'Edit Dokumen' : 'Tambah Dokumen Baru' }}
                        </h3>
                    </div>
                    <button wire:click="closeModal" class="size-8 bg-white hover:bg-neutral-100 border-2 border-black rounded-lg flex items-center justify-center font-bold text-black cursor-pointer shadow-brutal-sm">✕</button>
                </div>

                <!-- Form Container -->
                <form wire:submit="save" class="flex flex-col flex-1 overflow-hidden">
                    <!-- Modal Body (Scrollable with proper padding) -->
                    <div class="p-6 space-y-4 overflow-y-auto flex-1">
                        
                        <!-- Judul -->
                        <div class="space-y-1">
                            <label class="block text-xs font-black uppercase text-black">Judul Dokumen *</label>
                            <input wire:model.live.debounce.300ms="title" type="text" required placeholder="Contoh: Analisis Penerapan AI pada Sistem Akademik"
                                class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm" />
                            @error('title') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                        </div>

                        <!-- Slug -->
                        <div class="space-y-1">
                            <label class="block text-xs font-black uppercase text-black">Slug URL *</label>
                            <input wire:model="slug" type="text" required placeholder="analisis-penerapan-ai"
                                class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm font-mono" />
                            @error('slug') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Kategori -->
                            <div class="space-y-1">
                                <label class="block text-xs font-black uppercase text-black">Kategori *</label>
                                <select wire:model="category_id" required
                                    class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                            </div>

                            <!-- Tahun -->
                            <div class="space-y-1">
                                <label class="block text-xs font-black uppercase text-black">Tahun Terbit *</label>
                                <input wire:model="year" type="number" required placeholder="2026"
                                    class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm" />
                                @error('year') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Penulis -->
                            <div class="space-y-1">
                                <label class="block text-xs font-black uppercase text-black">Penulis / Author *</label>
                                <input wire:model="author" type="text" required placeholder="Nama Lengkap Penulis"
                                    class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm" />
                                @error('author') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                            </div>

                            <!-- Institusi -->
                            <div class="space-y-1">
                                <label class="block text-xs font-black uppercase text-black">Institusi / Fakultas *</label>
                                <input wire:model="institution" type="text" required placeholder="Fakultas Sains dan Teknologi"
                                    class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm" />
                                @error('institution') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="space-y-1">
                            <label class="block text-xs font-black uppercase text-black">Status Publikasi *</label>
                            <div class="flex items-center gap-4 pt-1">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input wire:model="status" type="radio" value="published" class="size-4 border-2 border-black text-black focus:ring-0">
                                    <span class="text-xs font-black text-black">Published (Tampil di Publik)</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input wire:model="status" type="radio" value="draft" class="size-4 border-2 border-black text-black focus:ring-0">
                                    <span class="text-xs font-black text-neutral-600">Draft (Tinjauan)</span>
                                </label>
                            </div>
                            @error('status') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                        </div>

                        <!-- Abstrak -->
                        <div class="space-y-1">
                            <label class="block text-xs font-black uppercase text-black">Abstrak / Ringkasan Dokumen *</label>
                            <textarea wire:model="abstract" rows="5" required placeholder="Tuliskan abstrak atau ringkasan dokumen di sini..."
                                class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm leading-relaxed"></textarea>
                            @error('abstract') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                        </div>

                        <!-- File Upload PDF -->
                        <div class="space-y-1">
                            <label class="block text-xs font-black uppercase text-black">
                                File Dokumen PDF {{ $dokumenId ? '(Opsional jika tidak ganti file)' : '*' }}
                            </label>
                            <input wire:model="file" type="file" accept=".pdf"
                                class="w-full p-2 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-2 file:border-black file:text-xs file:font-black file:bg-saweria file:text-black hover:file:bg-saweria-hover cursor-pointer" />
                            
                            <div wire:loading wire:target="file" class="text-xs font-black text-black flex items-center gap-1.5 pt-1">
                                <span class="animate-spin material-symbols-outlined text-[16px]">sync</span>
                                <span>Sedang mengunggah file PDF...</span>
                            </div>

                            @if ($existingFilePath && !$file)
                                <div class="text-[11px] font-bold text-neutral-500 pt-1">
                                    File tersimpan: <span class="font-mono text-black">{{ $existingFilePath }}</span>
                                </div>
                            @endif

                            @error('file') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Modal Actions (Fixed Footer) -->
                    <div class="p-4 sm:p-5 bg-[#FAF7EE] border-t-3 border-black flex items-center justify-end gap-3 shrink-0">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2.5 bg-white text-black font-bold text-xs uppercase rounded-xl border-2 border-black shadow-brutal-sm hover:bg-neutral-100 cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" wire:loading.attr="disabled"
                            class="px-6 py-2.5 bg-saweria hover:bg-saweria-hover text-black font-black text-xs uppercase rounded-xl border-2 border-black shadow-brutal hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer flex items-center gap-1.5">
                            <span wire:loading.remove wire:target="save">Simpan Dokumen</span>
                            <span wire:loading wire:target="save" class="flex items-center gap-1">
                                <span class="animate-spin material-symbols-outlined text-[16px]">sync</span>
                                <span>Menyimpan...</span>
                            </span>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if ($isDeleteModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white border-4 border-black rounded-3xl shadow-brutal-xl w-full max-w-md p-6 text-center space-y-4">
                <div class="size-16 bg-coral rounded-2xl border-3 border-black shadow-brutal mx-auto flex items-center justify-center text-white text-3xl">
                    🗑️
                </div>
                <div class="space-y-1">
                    <h3 class="text-lg font-black text-black">Hapus Dokumen?</h3>
                    <p class="text-xs font-semibold text-neutral-600">
                        Dokumen ini akan dipindahkan ke tempat sampah (Soft Delete).
                    </p>
                </div>
                <div class="flex items-center justify-center gap-3 pt-2">
                    <button wire:click="$set('isDeleteModalOpen', false)"
                        class="px-4 py-2 bg-white text-black font-bold text-xs uppercase rounded-xl border-2 border-black shadow-brutal-sm hover:bg-neutral-50 cursor-pointer">
                        Batal
                    </button>
                    <button wire:click="delete"
                        class="px-5 py-2 bg-coral hover:bg-red-600 text-white font-black text-xs uppercase rounded-xl border-2 border-black shadow-brutal hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>
