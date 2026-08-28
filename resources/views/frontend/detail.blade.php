@extends('layouts.frontend')

@section('title', $dokumen->title . ' — ' . (app(\App\Settings\GeneralSettings::class)->site_name ?? 'E-Repository'))

@section('content')
<div class="min-h-screen py-8 sm:py-12 bg-[#FAF7EE] pattern-grid">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Neobrutalist Breadcrumb -->
        <nav class="flex items-center gap-2 mb-8 text-xs font-black uppercase tracking-wider" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-white border-2 border-black rounded-xl shadow-brutal-sm hover:-translate-y-0.5 transition-all text-black">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                <span>Beranda</span>
            </a>
            <span class="text-black font-bold">/</span>
            <span class="px-3 py-1.5 bg-saweria text-black border-2 border-black rounded-xl shadow-brutal-sm truncate max-w-[200px] sm:max-w-md">
                {{ $dokumen->title }}
            </span>
        </nav>

        <!-- Main Detail Grid Container -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Document Metadata & Download (5 cols) -->
            <div class="lg:col-span-5 space-y-6">
                <!-- Main Info Card -->
                <div class="bg-white border-3 border-black rounded-3xl shadow-brutal-lg p-6 sm:p-8 space-y-6">
                    
                    <!-- Badges -->
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="px-3 py-1.5 bg-saweria text-black text-xs font-black uppercase rounded-xl border-2 border-black shadow-brutal-sm">
                            {{ $dokumen->category->name ?? 'Umum' }}
                        </span>
                        <span class="px-3 py-1.5 bg-mint text-black text-xs font-black rounded-xl border-2 border-black shadow-brutal-sm flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                            <span>Tahun {{ $dokumen->year }}</span>
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-xl sm:text-2xl font-black text-black leading-snug">
                        {{ $dokumen->title }}
                    </h1>

                    <!-- Author & Institution Info Boxes -->
                    <div class="space-y-3 pt-2">
                        <div class="p-3.5 bg-[#FAF7EE] border-2 border-black rounded-2xl shadow-brutal-sm space-y-1">
                            <div class="flex items-center gap-1.5 text-coral text-xs font-black uppercase tracking-wider">
                                <span class="material-symbols-outlined text-[18px]">person</span>
                                <span>Penulis / Peneliti</span>
                            </div>
                            <p class="text-sm sm:text-base font-extrabold text-black pl-6">
                                {{ $dokumen->author }}
                            </p>
                        </div>

                        <div class="p-3.5 bg-[#FAF7EE] border-2 border-black rounded-2xl shadow-brutal-sm space-y-1">
                            <div class="flex items-center gap-1.5 text-sky text-xs font-black uppercase tracking-wider">
                                <span class="material-symbols-outlined text-[18px]">school</span>
                                <span>Institusi / Fakultas</span>
                            </div>
                            <p class="text-sm sm:text-base font-extrabold text-black pl-6">
                                {{ $dokumen->institution }}
                            </p>
                        </div>
                    </div>

                    <!-- Download Section -->
                    <div class="pt-4 border-t-2 border-black space-y-3">
                        <div class="flex items-center justify-between text-xs font-bold text-neutral-600">
                            <span class="flex items-center gap-1">
                                <span class="size-2 bg-mint rounded-full border border-black inline-block"></span>
                                Format PDF Tersedia
                            </span>
                            <span class="font-extrabold text-black bg-neutral-100 px-2 py-0.5 rounded border border-black">
                                ⚡ {{ $dokumen->downloads ?? 0 }}x Diunduh
                            </span>
                        </div>

                        <a href="{{ route('dokumen.download', $dokumen->slug) }}" target="_blank"
                            class="group w-full py-4 px-6 bg-saweria hover:bg-saweria-hover text-black font-black text-base uppercase rounded-2xl border-3 border-black shadow-brutal hover:translate-x-1 hover:translate-y-1 hover:shadow-none active:translate-x-1 active:translate-y-1 active:shadow-none transition-all flex items-center justify-center gap-2 cursor-pointer">
                            <span class="material-symbols-outlined text-2xl font-bold group-hover:animate-bounce">download</span>
                            <span>UNDUH DOKUMEN PDF</span>
                        </a>
                    </div>
                </div>

                <!-- Citation / Quick Tip Box -->
                <div class="p-5 bg-lavender border-3 border-black rounded-2xl shadow-brutal space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">💡</span>
                        <h4 class="font-black text-black text-xs uppercase tracking-wider">Panduan Sitasi</h4>
                    </div>
                    <p class="text-xs font-semibold text-neutral-800 leading-relaxed">
                        Gunakan dokumen ini untuk kepentingan riset, karya tulis, dan sitasi akademik dengan mencantumkan nama penulis serta institusi terkait.
                    </p>
                </div>
            </div>

            <!-- Right Column: Abstract & Full Text Preview (7 cols) -->
            <div class="lg:col-span-7">
                <div class="bg-white border-3 border-black rounded-3xl shadow-brutal-lg p-6 sm:p-10 space-y-6">
                    
                    <!-- Abstract Header -->
                    <div class="flex items-center justify-between pb-4 border-b-3 border-black">
                        <div class="flex items-center gap-2">
                            <div class="size-9 bg-saweria border-2 border-black rounded-xl shadow-brutal-sm flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl font-bold">description</span>
                            </div>
                            <h2 class="text-xl sm:text-2xl font-black text-black tracking-tight">
                                Abstrak &amp; Ringkasan
                            </h2>
                        </div>
                        <span class="hidden sm:inline-block px-2.5 py-1 bg-pinkpop text-black text-[11px] font-black uppercase rounded-lg border border-black shadow-brutal-sm">
                            Official Archive
                        </span>
                    </div>

                    <!-- Abstract Content -->
                    <div class="text-neutral-800 text-sm sm:text-base leading-relaxed text-justify font-medium space-y-4">
                        {!! nl2br(e($dokumen->abstract)) !!}
                    </div>

                    <!-- Document Metadata Footer Strip -->
                    <div class="pt-6 mt-6 border-t-2 border-black flex flex-wrap items-center justify-between gap-4 text-xs font-bold text-neutral-600">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">verified</span>
                            <span>Status: Published (Open Access)</span>
                        </div>
                        
                        <a href="{{ route('home') }}" class="font-black text-black hover:underline flex items-center gap-1">
                            <span>Jelajahi Dokumen Lainnya</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection