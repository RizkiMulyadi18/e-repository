@extends('layouts.frontend')

@section('content')
<div class="relative bg-blue-900 py-24 sm:py-32 bg-[url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center bg-no-repeat bg-fixed">
    <div class="absolute inset-0 bg-blue-900/80 mix-blend-multiply"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
            Pusat Pengetahuan & Karya Ilmiah
        </h1>
        <p class="mt-6 text-xl text-blue-100 max-w-2xl mx-auto font-light leading-relaxed">
            Telusuri ribuan Skripsi, Tesis, dan Jurnal penelitian dari civitas akademika Universitas Malikussaleh.
        </p>

        <div class="mt-10 max-w-2xl mx-auto">
            <form action="{{ route('home') }}" method="GET" class="relative flex items-center bg-white rounded-full shadow-2xl p-1.5 transition-all focus-within:ring-4 focus-within:ring-blue-500/30">
                <svg class="w-6 h-6 ml-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="block w-full border-0 bg-transparent py-4 pl-3 pr-4 text-gray-900 placeholder:text-gray-500 focus:ring-0 sm:text-lg outline-none"
                    placeholder="Cari berdasarkan judul, penulis, atau kata kunci..." autocomplete="off">
                <button type="submit"
                    class="inline-flex items-center rounded-full bg-amber-500 px-8 py-3.5 text-base font-bold text-white shadow-sm hover:bg-amber-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-500 transition-all active:scale-95">
                    Cari Referensi
                </button>
            </form>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Dokumen Terbaru</h2>
        
        <div class="flex gap-2">
            <a href="{{ route('home') }}" class="category-link px-3 py-1 text-sm rounded-full {{ !request('category') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            Semua</a>
            <a href="{{ route('home', ['category' => 'Skripsi']) }}" class="category-link px-3 py-1 text-sm rounded-full {{ request('category') == 'Skripsi' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            Skripsi</a>
            <a href="{{ route('home', ['category' => 'Jurnal']) }}" class="category-link px-3 py-1 text-sm rounded-full {{ request('category') == 'Jurnal' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            Jurnal</a>
        </div>
    </div>
    <div id="dokumen-container" class="min-h-[400px]">
        @include('frontend.partials.list-dokumen')
        </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Ketika tombol kategori diklik
        $(document).on('click', '.category-link', function(e) {
            e.preventDefault(); // Mencegah refresh halaman
            
            let url = $(this).attr('href'); // Ambil URL tujuan
            
            // Ubah tampilan tombol aktif (opsional, biar cantik)
            $('.category-link').removeClass('bg-blue-600 text-white').addClass('bg-gray-100 text-gray-600');
            $(this).removeClass('bg-gray-100 text-gray-600').addClass('bg-blue-600 text-white');

            // Tampilkan efek loading sederhana
            $('#dokumen-container').css('opacity', '0.5');

            // Request AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Ganti isi container dengan data baru
                    $('#dokumen-container').html(response);
                    $('#dokumen-container').css('opacity', '1');
                    
                    // Ubah URL di address bar browser tanpa refresh
                    window.history.pushState(null, '', url);
                },
                error: function() {
                    alert('Gagal memuat data.');
                    $('#dokumen-container').css('opacity', '1');
                }
            });
        });

        // Agar Pagination juga tidak refresh (Opsional)
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            $('#dokumen-container').css('opacity', '0.5');
            $.ajax({
                url: url,
                success: function(response) {
                    $('#dokumen-container').html(response);
                    $('#dokumen-container').css('opacity', '1');
                    window.history.pushState(null, '', url);
                    // Scroll ke atas grid
                    $('html, body').animate({
                        scrollTop: $("#dokumen-container").offset().top - 100
                    }, 500);
                }
            });
        });
    });
</script>
@endsection