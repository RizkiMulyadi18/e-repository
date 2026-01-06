@if ($dokumens->count() > 0)
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($dokumens as $item)
            <div
                class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 flex flex-col h-full transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="p-6 grow relative">
                    <div class="absolute top-0 inset-x-0 h-1 bg-blue-600 group-hover:bg-amber-500 transition-colors">
                    </div>

                    <div class="flex items-center gap-x-3 text-xs mb-4">
                        @php
                            $badgeColor = match ($item->category) {
                                'Jurnal' => 'bg-green-50 text-green-700 ring-green-600/20',
                                'Tesis' => 'bg-purple-50 text-purple-700 ring-purple-600/20',
                                default => 'bg-blue-50 text-blue-700 ring-blue-600/20', // Skripsi dll
                            };
                        @endphp
                        <span
                            class="inline-flex items-center rounded-md {{ $badgeColor }} px-2 py-1 text-xs font-medium ring-1 ring-inset">
                            {{ $item->category }}
                        </span>
                        <span class="text-gray-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $item->year }}
                        </span>
                    </div>
                    <h3
                        class="mt-2 text-xl font-bold text-gray-900 leading-snug group-hover:text-blue-700 transition-colors line-clamp-2">
                        <a href="{{ route('dokumen.show', $item->id) }}">
                            {{ $item->title }}
                        </a>
                    </h3>
                    <p class="mt-3 text-sm text-gray-600 line-clamp-3 leading-relaxed">
                        {{ $item->abstract }}
                    </p>

                    <div class="mt-6 pt-4 border-t border-gray-50 flex items-center">
                        <div
                            class="shrink-0 h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold">
                            {{ substr($item->author, 0, 1) }} </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900 line-clamp-1">{{ $item->authors }}</p>
                            <p class="text-xs text-gray-500 line-clamp-1">{{ $item->institution }}</p>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-gray-50 px-6 py-4 rounded-b-2xl border-t border-gray-100 group-hover:bg-blue-50 transition-colors">
                    <a href="{{ route('dokumen.show', $item->id) }}"
                        class="text-sm font-bold text-blue-700 hover:text-blue-800 flex items-center justify-between w-full">
                        Buka Dokumen Lengkap
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $dokumens->withQueryString()->links() }}
    </div>
@else
    <div class="text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
        <p class="text-gray-500">Tidak ada dokumen ditemukan.</p>
        <a href="{{ route('home') }}" class="text-blue-600 text-sm hover:underline mt-2 inline-block">Reset
            Pencarian</a>
    </div>
@endif
