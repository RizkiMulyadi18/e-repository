<div>
    @section('title', 'Kelola Pengguna')
    @section('header', 'Manajemen Pengguna')

    <!-- Action & Filter Bar -->
    <div class="mb-6 p-5 sm:p-6 bg-white border-3 border-black rounded-3xl shadow-brutal-md flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        
        <!-- Search Input -->
        <div class="relative w-full sm:w-80">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
                <span class="material-symbols-outlined text-[20px]">search</span>
            </span>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama atau email..."
                class="w-full pl-10 pr-4 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black placeholder:text-neutral-400 focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm transition-all" />
        </div>

        <!-- Add Button -->
        <button wire:click="openCreateModal"
            class="px-5 py-2.5 bg-saweria hover:bg-saweria-hover text-black font-black text-xs uppercase rounded-xl border-2 border-black shadow-brutal-sm hover:-translate-y-0.5 hover:shadow-brutal active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center justify-center gap-1.5 cursor-pointer">
            <span class="material-symbols-outlined text-[18px]">person_add</span>
            <span>Tambah Pengguna</span>
        </button>
    </div>

    <!-- Table Container -->
    <div class="bg-white border-3 border-black rounded-3xl shadow-brutal-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#FAF7EE] border-b-2 border-black text-[11px] font-black uppercase text-black tracking-wider">
                        <th class="py-3.5 px-6">Pengguna</th>
                        <th class="py-3.5 px-4">Email</th>
                        <th class="py-3.5 px-4">Peran (Role)</th>
                        <th class="py-3.5 px-4">Terdaftar Sejak</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-neutral-100 text-xs font-bold text-neutral-800">
                    @forelse ($users as $u)
                        <tr class="hover:bg-[#FFFDF7] transition-colors">
                            <!-- Name with initial avatar -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="size-9 bg-saweria border-2 border-black rounded-xl shadow-[2px_2px_0px_#000] flex items-center justify-center font-black text-black text-sm">
                                        {{ substr($u->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-black text-black text-sm">{{ $u->name }}</div>
                                        @if ($u->id === auth()->id())
                                            <span class="text-[10px] font-black text-emerald-600">(Akun Anda)</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Email -->
                            <td class="py-4 px-4 font-mono text-[11px] text-neutral-600">
                                {{ $u->email }}
                            </td>

                            <!-- Role Badge -->
                            <td class="py-4 px-4">
                                @if ($u->role === 'admin')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-saweria text-black border border-black rounded-lg text-[11px] font-black shadow-[1px_1px_0px_#000]">
                                        <span>👑</span>
                                        <span>Administrator</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-mint text-black border border-black rounded-lg text-[11px] font-black shadow-[1px_1px_0px_#000]">
                                        <span>✍️</span>
                                        <span>Editor</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Created At -->
                            <td class="py-4 px-4 text-neutral-500 text-[11px]">
                                {{ $u->created_at ? $u->created_at->format('d M Y') : '-' }}
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button wire:click="openEditModal({{ $u->id }})" title="Edit Pengguna"
                                        class="size-8 bg-saweria hover:bg-saweria-hover border-2 border-black rounded-lg flex items-center justify-center shadow-brutal-sm hover:-translate-y-0.5 transition-all text-black cursor-pointer">
                                        <span class="material-symbols-outlined text-[16px]">edit</span>
                                    </button>

                                    @if ($u->id !== auth()->id())
                                        <button wire:click="confirmDelete({{ $u->id }})" title="Hapus Pengguna"
                                            class="size-8 bg-coral hover:bg-red-600 border-2 border-black rounded-lg flex items-center justify-center shadow-brutal-sm hover:-translate-y-0.5 transition-all text-white cursor-pointer">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-16 text-center text-neutral-500 font-bold">
                                Tidak ada pengguna ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-[#FAF7EE] border-t-2 border-black">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Create / Edit Modal -->
    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white border-4 border-black rounded-3xl shadow-brutal-xl w-full max-w-md overflow-hidden animate-fade-in-up">
                
                <div class="p-5 bg-[#FFFDF7] border-b-3 border-black flex items-center justify-between">
                    <h3 class="text-base font-black text-black">
                        {{ $userId ? 'Edit Pengguna' : 'Tambah Pengguna Baru' }}
                    </h3>
                    <button wire:click="closeModal" class="size-8 bg-white border-2 border-black rounded-lg flex items-center justify-center font-bold">✕</button>
                </div>

                <form wire:submit="save" class="p-6 space-y-4">
                    <div class="space-y-1">
                        <label class="block text-xs font-black uppercase text-black">Nama Lengkap *</label>
                        <input wire:model="name" type="text" required placeholder="Nama Pengguna"
                            class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm" />
                        @error('name') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-xs font-black uppercase text-black">Email *</label>
                        <input wire:model="email" type="email" required placeholder="email@domain.com"
                            class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm" />
                        @error('email') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-xs font-black uppercase text-black">
                            Password {{ $userId ? '(Kosongkan jika tidak diganti)' : '*' }}
                        </label>
                        <input wire:model="password" type="password" {{ $userId ? '' : 'required' }} placeholder="Minimal 6 karakter"
                            class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm" />
                        @error('password') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-xs font-black uppercase text-black">Peran (Role) *</label>
                        <select wire:model="role" required
                            class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm">
                            <option value="editor">✍️ Editor (Kelola Dokumen & Kategori)</option>
                            <option value="admin">👑 Administrator (Akses Penuh)</option>
                        </select>
                        @error('role') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-4 border-t-2 border-black flex items-center justify-end gap-3">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2.5 bg-white text-black font-bold text-xs uppercase rounded-xl border-2 border-black shadow-brutal-sm hover:bg-neutral-50 cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-saweria hover:bg-saweria-hover text-black font-black text-xs uppercase rounded-xl border-2 border-black shadow-brutal hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                            Simpan Pengguna
                        </button>
                    </div>
                </form>

            </div>
        </div>
    @endif

    <!-- Delete Modal -->
    @if ($isDeleteModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white border-4 border-black rounded-3xl shadow-brutal-xl w-full max-w-md p-6 text-center space-y-4">
                <div class="size-16 bg-coral rounded-2xl border-3 border-black shadow-brutal mx-auto flex items-center justify-center text-white text-3xl">
                    🗑️
                </div>
                <div class="space-y-1">
                    <h3 class="text-lg font-black text-black">Hapus Pengguna?</h3>
                    <p class="text-xs font-semibold text-neutral-600">
                        Akun pengguna ini akan dihapus dari sistem.
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
