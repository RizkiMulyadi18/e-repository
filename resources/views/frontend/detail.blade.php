@extends('layouts.frontend')

@section('content')
<div class="bg-gray-50/50 min-h-screen py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex mb-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                        <span class="ml-1 text-gray-500 md:ml-2 truncate max-w-[200px]">{{ $dokumen->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="bg-white shadow-xl rounded-3xl overflow-hidden border border-gray-100">
            <div class="lg:grid lg:grid-cols-3 lg:gap-0">
                <div class="bg-slate-50 px-6 py-8 lg:p-10 lg:border-r border-gray-100 lg:col-span-1">
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-800">
                            {{ $dokumen->category }}
                        </span>
                        <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-800">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $dokumen->year }}
                        </span>
                    </div>

                    <h1 class="text-2xl font-extrabold text-gray-900 leading-tight mb-6">
                        {{ $dokumen->title }}
                    </h1>

                    <div class="space-y-4 mb-8">
                        <div>
                             <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Penulis</h3>
                             <p class="mt-1 text-lg font-medium text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                {{ $dokumen->author }}
                             </p>
                        </div>
                        <div>
                             <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Institusi</h3>
                             <p class="mt-1 text-base text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                {{ $dokumen->institution }}
                             </p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Aksi Dokumen</h3>
                        <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank" class="group relative w-full flex justify-center py-4 px-4 border border-transparent font-bold rounded-xl text-white bg-amber-500 hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 shadow-lg hover:shadow-xl transition-all active:scale-95 overflow-hidden">
                            <span class="absolute inset-0 w-full h-full bg-gradient-to-br from-amber-400 to-amber-600 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            <span class="relative flex items-center">
                                <svg class="w-6 h-6 mr-2 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Download Full PDF
                            </span>
                        </a>
                        <p class="text-center text-xs text-gray-500 mt-3 flex justify-center items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            File Terverifikasi Aman
                        </p>
                    </div>
                </div>

                <div class="px-6 py-8 lg:p-10 lg:col-span-2">
                    <div class="prose prose-blue max-w-none">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center pb-4 border-b border-gray-100">
                            <svg class="w-7 h-7 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                            Abstrak / Ringkasan
                        </h2>
                        <div class="text-gray-700 text-lg leading-8 text-justify font-light tracking-wide">
                            {!! nl2br(e($dokumen->abstract)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection