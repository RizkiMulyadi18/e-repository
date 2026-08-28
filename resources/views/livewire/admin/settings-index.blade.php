<div>
    @section('title', 'Pengaturan Website')
    @section('header', 'Pengaturan Website')

    <!-- Flash Notifications -->
    @if (session()->has('success'))
        <div class="mb-6 p-4 bg-mint border-3 border-black rounded-2xl shadow-brutal flex items-center justify-between gap-3 animate-fade-in-up">
            <div class="flex items-center gap-2.5 text-black font-black text-xs sm:text-sm">
                <span class="material-symbols-outlined text-xl">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="size-6 bg-white border-2 border-black rounded-md flex items-center justify-center font-bold text-xs hover:bg-neutral-100">✕</button>
        </div>
    @endif

    @if (session()->has('warning'))
        <div class="mb-6 p-4 bg-saweria border-3 border-black rounded-2xl shadow-brutal flex items-center justify-between gap-3 animate-fade-in-up">
            <div class="flex items-center gap-2.5 text-black font-black text-xs sm:text-sm">
                <span class="material-symbols-outlined text-xl">warning</span>
                <span>{{ session('warning') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="size-6 bg-white border-2 border-black rounded-md flex items-center justify-center font-bold text-xs hover:bg-neutral-100">✕</button>
        </div>
    @endif

    <form wire:submit="save" class="space-y-8 max-w-4xl">

        <!-- Card 1: Identitas Repositori -->
        <div class="bg-white border-3 border-black rounded-3xl shadow-brutal-lg p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-2 pb-4 border-b-2 border-black">
                <div class="size-8 bg-saweria rounded-xl border-2 border-black flex items-center justify-center font-bold shadow-brutal-sm">
                    <span class="material-symbols-outlined text-lg">tune</span>
                </div>
                <div>
                    <h3 class="text-base sm:text-lg font-black text-black">Identitas &amp; Logo Repositori</h3>
                    <p class="text-xs font-semibold text-neutral-500">Nama situs, logo institusi, dan teks footer.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Nama Situs -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="block text-xs font-black uppercase text-black">Nama Website Repositori *</label>
                    <input wire:model="site_name" type="text" required placeholder="Contoh: E-Repository Universitas"
                        class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm" />
                    @error('site_name') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                </div>

                <!-- Logo Upload -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="block text-xs font-black uppercase text-black">Logo Repositori</label>
                    <input wire:model="site_logo" type="file" accept="image/*"
                        class="w-full p-2 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-2 file:border-black file:text-xs file:font-black file:bg-saweria file:text-black cursor-pointer" />
                    
                    <div wire:loading wire:target="site_logo" class="text-xs font-bold text-black flex items-center gap-1 pt-1">
                        <span class="animate-spin material-symbols-outlined text-[14px]">sync</span>
                        <span>Mengunggah logo...</span>
                    </div>

                    @if ($existing_logo && !$site_logo)
                        <div class="flex items-center gap-2 pt-2">
                            <span class="text-xs font-bold text-neutral-500">Logo Saat Ini:</span>
                            <img src="{{ asset('storage/' . $existing_logo) }}" alt="Logo" class="h-8 w-auto border border-black rounded p-0.5 bg-white">
                        </div>
                    @endif

                    @error('site_logo') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                </div>

                <!-- Status Aktif Website -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="block text-xs font-black uppercase text-black">Status Akses Publik &amp; Mode Maintenance</label>
                    <div class="p-4 bg-[#FAF7EE] border-2 border-black rounded-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-brutal-sm">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-black {{ $site_active ? 'text-black' : 'text-coral' }}">
                                    {{ $site_active ? 'Website Aktif (Akses Publik Terbuka)' : 'Mode Maintenance Aktif (Website Nonaktif)' }}
                                </span>
                                <span class="px-2 py-0.5 text-[10px] font-black uppercase rounded border border-black {{ $site_active ? 'bg-mint text-black' : 'bg-coral text-white' }}">
                                    {{ $site_active ? 'ONLINE' : 'MAINTENANCE' }}
                                </span>
                            </div>
                            <p class="text-[11px] font-bold text-neutral-600">
                                {{ $site_active ? 'Pengunjung umum dapat mencari, membaca, dan mengunduh dokumen secara bebas.' : 'Pengunjung umum akan diarahkan ke halaman "Sedang Dalam Pemeliharaan". Admin & Editor tetap dapat login dan mengelola data.' }}
                            </p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer shrink-0">
                            <input wire:model.live="site_active" type="checkbox" class="sr-only peer">
                            <div class="w-14 h-7 bg-neutral-300 peer-focus:outline-none border-2 border-black rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-black after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white after:border-2 after:border-black after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-mint shadow-brutal-sm"></div>
                        </label>
                    </div>
                </div>

                <!-- Footer Deskriptif -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="block text-xs font-black uppercase text-black">Deskripsi Singkat Footer</label>
                    <textarea wire:model="footer_text" rows="2" placeholder="Deskripsi singkat yang tampil di bagian bawah halaman..."
                        class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm"></textarea>
                </div>

                <!-- Copyright Text -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="block text-xs font-black uppercase text-black">Teks Hak Cipta (Copyright)</label>
                    <input wire:model="site_footer" type="text" placeholder="Copyright © 2026 Universitas"
                        class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm" />
                </div>
            </div>
        </div>

        <!-- Card 2: Kontak & Alamat -->
        <div class="bg-white border-3 border-black rounded-3xl shadow-brutal-lg p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-2 pb-4 border-b-2 border-black">
                <div class="size-8 bg-sky rounded-xl border-2 border-black flex items-center justify-center font-bold shadow-brutal-sm">
                    <span class="material-symbols-outlined text-lg">contact_mail</span>
                </div>
                <div>
                    <h3 class="text-base sm:text-lg font-black text-black">Informasi Kontak &amp; Lokasi</h3>
                    <p class="text-xs font-semibold text-neutral-500">Alamat kampus, nomor telepon, dan email resmi.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Alamat -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="block text-xs font-black uppercase text-black">Alamat Kampus / Perpustakaan</label>
                    <input wire:model="site_address" type="text" placeholder="Jl. Kampus No. 1, Jakarta"
                        class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm" />
                </div>

                <!-- Email Kontak -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-black uppercase text-black">Email Kontak Resmi</label>
                    <input wire:model="site_email" type="email" placeholder="repository@kampus.ac.id"
                        class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm" />
                    @error('site_email') <span class="text-coral text-[11px] font-bold">{{ $message }}</span> @enderror
                </div>

                <!-- Telepon / WA -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-black uppercase text-black">Nomor WhatsApp / Telepon</label>
                    <input wire:model="site_phone" type="text" placeholder="081234567890"
                        class="w-full px-3.5 py-2.5 bg-[#FAF7EE] border-2 border-black rounded-xl text-xs font-bold text-black focus:bg-white focus:outline-none focus:ring-0 focus:shadow-brutal-sm" />
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end">
            <button type="submit" wire:loading.attr="disabled"
                class="px-8 py-3.5 bg-saweria hover:bg-saweria-hover text-black font-black text-sm uppercase rounded-xl border-3 border-black shadow-brutal hover:-translate-y-0.5 hover:shadow-brutal-md active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center gap-2 cursor-pointer">
                <span class="material-symbols-outlined text-[20px]">save</span>
                <span>Simpan Seluruh Pengaturan</span>
            </button>
        </div>

    </form>
</div>
