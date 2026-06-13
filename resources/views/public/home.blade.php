<!-- resources/views/public/home.blade.php -->
@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

  {{-- ── HERO SECTION ── --}}
  @if($featuredPost)
  <section class="bg-gradient-to-br from-primary-800 via-primary-700 
                  to-primary-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

        {{-- Teks Hero --}}
        <div>
          <span class="badge bg-primary-500 text-white mb-4">
            ✨ Berita Terbaru
          </span>
          <a href="{{ route('posts.show', $featuredPost->slug) }}">
            <h1 class="text-3xl lg:text-4xl font-bold leading-tight mb-4 
                       hover:text-primary-200 transition-colors">
              {{ $featuredPost->title }}
            </h1>
          </a>
          <p class="text-primary-100 text-lg mb-6 leading-relaxed">
            {{ $featuredPost->excerpt }}
          </p>
          <div class="flex items-center gap-4 text-sm text-primary-200 mb-6">
            <span class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" 
                   viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 
                         7h14a7 7 0 00-7-7z"/>
              </svg>
              {{ $featuredPost->author->name }}
            </span>
            <span class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" 
                   viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 
                         00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
              {{ $featuredPost->published_at?->translatedFormat('d F Y') 
                 ?? $featuredPost->created_at->translatedFormat('d F Y') }}
            </span>
          </div>
          <div class="flex gap-3">
            <a href="{{ route('posts.show', $featuredPost->slug) }}" 
               class="btn-primary bg-white text-primary-700 
                      hover:bg-primary-50">
              Baca Selengkapnya →
            </a>
            <a href="{{ route('category.show', $featuredPost->category->slug) }}"
               class="btn-outline border-white text-white 
                      hover:bg-white hover:text-primary-700">
              {{ $featuredPost->category->name }}
            </a>
          </div>
        </div>

        {{-- Gambar Hero --}}
        <div class="relative">
          @if($featuredPost->image)
            <img src="{{ asset('storage/' . $featuredPost->image) }}"
                 alt="{{ $featuredPost->title }}"
                 class="w-full h-80 object-cover rounded-2xl shadow-2xl"/>
          @else
            <div class="w-full h-80 bg-primary-500 rounded-2xl shadow-2xl 
                        flex items-center justify-center">
              <div class="text-center text-primary-200">
                <svg class="w-24 h-24 mx-auto mb-3 opacity-50" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" 
                        stroke-width="1"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 
                           2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 
                           00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-sm opacity-75">EcoBetapus</p>
              </div>
            </div>
          @endif
          {{-- Badge kategori di atas gambar --}}
          <span class="absolute top-4 left-4 badge bg-white text-primary-700 
                       shadow-md">
            {{ $featuredPost->category->name }}
          </span>
        </div>

      </div>
    </div>
  </section>
  @endif

  {{-- ── STATS STRIP ── --}}
  <section class="bg-primary-600 text-white py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <div>
          <div class="text-2xl font-bold">5 UMKM</div>
          <div class="text-primary-200 text-sm">Penerima PLTS</div>
        </div>
        <div>
          <div class="text-2xl font-bold">37,2 kg</div>
          <div class="text-primary-200 text-sm">Sampah Organik/Hari</div>
        </div>
        <div>
          <div class="text-2xl font-bold">408 Siswa</div>
          <div class="text-primary-200 text-sm">Terima Edukasi</div>
        </div>
        <div>
          <div class="text-2xl font-bold">5.250 kg</div>
          <div class="text-primary-200 text-sm">Reduksi CO₂/Tahun</div>
        </div>
      </div>
    </div>
  </section>

  {{-- ── BERITA TERBARU ── --}}
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="flex items-center justify-between mb-8">
      <div>
        <h2 class="text-2xl font-bold text-gray-800">Berita Terbaru</h2>
        <p class="text-gray-500 text-sm mt-1">
          Informasi terkini dari kawasan Sawah Betapus
        </p>
      </div>
      <a href="{{ route('posts.index') }}"
         class="text-primary-600 hover:text-primary-700 font-medium text-sm 
                flex items-center gap-1">
        Lihat Semua →
      </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse($recentPosts as $post)
      <article class="card overflow-hidden group">
        {{-- Gambar --}}
        <a href="{{ route('posts.show', $post->slug) }}" class="block">
          @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}"
                 alt="{{ $post->title }}"
                 class="w-full h-48 object-cover group-hover:scale-105 
                        transition-transform duration-300"/>
          @else
            <div class="w-full h-48 bg-gradient-to-br from-primary-100 
                        to-primary-200 flex items-center justify-center">
              <svg class="w-16 h-16 text-primary-400" fill="none" 
                   stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      stroke-width="1"
                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586
                         a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 
                         2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
            </div>
          @endif
        </a>

        <div class="p-5">
          {{-- Kategori --}}
          <a href="{{ route('category.show', $post->category->slug) }}"
             class="badge bg-primary-100 text-primary-700 
                    hover:bg-primary-200 transition-colors mb-3">
            {{ $post->category->name }}
          </a>

          {{-- Judul --}}
          <a href="{{ route('posts.show', $post->slug) }}">
            <h3 class="font-bold text-gray-800 text-lg leading-snug mb-2 
                       hover:text-primary-700 transition-colors line-clamp-2">
              {{ $post->title }}
            </h3>
          </a>

          {{-- Ringkasan --}}
          <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2">
            {{ $post->excerpt }}
          </p>

          {{-- Meta --}}
          <div class="flex items-center justify-between text-xs text-gray-400 
                      pt-3 border-t border-gray-100">
            <span class="flex items-center gap-1">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" 
                   viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 
                         7h14a7 7 0 00-7-7z"/>
              </svg>
              {{ $post->author->name }}
            </span>
            <span>
              {{ $post->published_at?->format('d M Y') 
                 ?? $post->created_at->format('d M Y') }}
            </span>
          </div>
        </div>
      </article>
      @empty
      <div class="col-span-3 text-center py-12 text-gray-400">
        Belum ada berita tersedia.
      </div>
      @endforelse
    </div>
  </section>

  {{-- ── KATEGORI SECTION ── --}}
  <section class="bg-primary-50 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-10">
        <h2 class="text-2xl font-bold text-gray-800">Jelajahi Berdasarkan Topik</h2>
        <p class="text-gray-500 mt-1 text-sm">
          Temukan informasi sesuai bidang yang kamu minati
        </p>
      </div>

      @php
        $categoryIcons = [
          'energi'     => '⚡',
          'lingkungan' => '🌿',
          'edukasi'    => '📚',
          'ekonomi'    => '💰',
          'wisata'     => '🏞️',
        ];
      @endphp

      <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        @foreach($categories as $cat)
        <a href="{{ route('category.show', $cat->slug) }}"
           class="card p-6 text-center hover:border-primary-300 
                  hover:-translate-y-1 transition-all duration-200 group">
          <div class="text-4xl mb-3">
            {{ $categoryIcons[$cat->slug] ?? '📰' }}
          </div>
          <h3 class="font-semibold text-gray-700 group-hover:text-primary-700 
                     transition-colors">
            {{ $cat->name }}
          </h3>
          <p class="text-xs text-gray-400 mt-1">
            {{ $cat->posts_count }} artikel
          </p>
        </a>
        @endforeach
      </div>
    </div>
  </section>

@endsection