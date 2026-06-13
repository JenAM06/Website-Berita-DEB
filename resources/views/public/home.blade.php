<!-- resources/views/public/home.blade.php -->
@extends('layouts.app')
@section('title', 'Beranda')

@section('content')

  {{-- ── HERO BERITA UTAMA (layout PF style) ── --}}
  @if($featuredPost)
  <section class="max-w-7xl mx-auto px-4 sm:px-6 py-10">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

      {{-- Berita Utama Kiri --}}
      <div class="lg:col-span-2">
        <a href="{{ route('posts.show', $featuredPost->slug) }}" class="block group">
          {{-- Gambar --}}
          @if($featuredPost->image)
            <div class="overflow-hidden">
              <img src="{{ $featuredPost->image_url }}"
                   alt="{{ $featuredPost->title }}"
                   class="w-full h-80 object-cover group-hover:scale-105 
                          transition-transform duration-500"/>
            </div>
          @else
            <div class="w-full h-80 bg-gradient-to-br from-primary-700 
                        to-primary-900 flex items-center justify-center">
              <svg class="w-20 h-20 text-primary-500" fill="none" 
                   stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      stroke-width="1"
                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586
                         a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 
                         2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
            </div>
          @endif

          {{-- Meta --}}
          <div class="mt-4">
            <span class="badge bg-transparent text-primary-600 border-0 
                         pl-0 tracking-widest text-xs font-bold">
              {{ strtoupper($featuredPost->category->name) }}
            </span>
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mt-1 
                       leading-snug group-hover:text-primary-700 transition-colors">
              {{ $featuredPost->title }}
            </h1>
            <p class="text-gray-500 mt-2 text-sm leading-relaxed line-clamp-2">
              {{ $featuredPost->excerpt }}
            </p>
            <div class="flex items-center gap-3 mt-3 text-xs text-gray-400">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" 
                   viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 
                         00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
              {{ $featuredPost->published_at?->translatedFormat('d F Y') 
                 ?? $featuredPost->created_at->translatedFormat('d F Y') }}
            </div>
          </div>
        </a>
      </div>

      {{-- Berita List Kanan --}}
      <div class="space-y-0 border-l border-gray-100 pl-8">
        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest 
                   mb-4 pb-2 border-b border-gray-100">
          Berita Lainnya
        </h3>
        @foreach($recentPosts as $post)
        <a href="{{ route('posts.show', $post->slug) }}"
           class="flex gap-4 py-4 border-b border-gray-100 group
                  last:border-0">
          {{-- Gambar Kecil --}}
          @if($post->image)
            <img src="{{ $post->image_url }}"
                 alt="{{ $post->title }}"
                 class="w-20 h-16 object-cover shrink-0"/>
          @else
            <div class="w-20 h-16 bg-gray-100 shrink-0 flex items-center 
                        justify-center">
              <svg class="w-6 h-6 text-gray-300" fill="none" 
                   stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      stroke-width="1.5"
                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586
                         a2 2 0 012.828 0L20 14"/>
              </svg>
            </div>
          @endif

          <div class="flex-1 min-w-0">
            <span class="text-xs font-bold text-primary-600 uppercase 
                         tracking-wider">
              {{ $post->category->name }}
            </span>
            <h4 class="text-sm font-semibold text-gray-800 leading-snug mt-0.5 
                       line-clamp-2 group-hover:text-primary-700 transition-colors">
              {{ $post->title }}
            </h4>
            <p class="text-xs text-gray-400 mt-1">
              {{ $post->published_at?->format('d M Y') 
                 ?? $post->created_at->format('d M Y') }}
            </p>
          </div>
        </a>
        @endforeach

        <div class="pt-4">
          <a href="{{ route('posts.index') }}"
             class="text-sm font-semibold text-primary-600 
                    hover:text-primary-700 transition-colors 
                    flex items-center gap-1">
            Lihat semua berita
            <svg class="w-4 h-4" fill="none" stroke="currentColor" 
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" 
                    stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </a>
        </div>
      </div>

    </div>
  </section>
  @endif

  {{-- ── DIVIDER ── --}}
  <div class="border-t border-gray-100"></div>

  {{-- ── STATS BAR ── --}}
  <section class="bg-primary-700 text-white py-8">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach([
          ['5 UMKM',    'Penerima PLTS Off-Grid'],
          ['37,2 kg',   'Sampah Organik per Hari'],
          ['408 Siswa', 'Mendapat Edukasi'],
          ['5.250 kg',  'Reduksi CO2 per Tahun'],
        ] as [$val, $label])
        <div class="text-center">
          <p class="text-2xl font-black text-white">{{ $val }}</p>
          <p class="text-xs text-primary-200 mt-1 uppercase tracking-wider">
            {{ $label }}
          </p>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- ── KATEGORI ── --}}
  <section class="max-w-7xl mx-auto px-4 sm:px-6 py-12">
    <div class="flex items-end justify-between mb-6">
      <div>
        <div class="section-divider"></div>
        <h2 class="section-title">Jelajahi Kategori</h2>
      </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
      @php
        $catColors = [
          'energi'     => 'border-yellow-400 hover:bg-yellow-50',
          'lingkungan' => 'border-green-500 hover:bg-green-50',
          'edukasi'    => 'border-blue-500 hover:bg-blue-50',
          'ekonomi'    => 'border-purple-500 hover:bg-purple-50',
          'wisata'     => 'border-orange-400 hover:bg-orange-50',
        ];
        $catText = [
          'energi'     => 'text-yellow-600',
          'lingkungan' => 'text-green-600',
          'edukasi'    => 'text-blue-600',
          'ekonomi'    => 'text-purple-600',
          'wisata'     => 'text-orange-500',
        ];
      @endphp

      @foreach($categories as $cat)
      <a href="{{ route('category.show', $cat->slug) }}"
         class="border-t-4 {{ $catColors[$cat->slug] ?? 'border-gray-300 hover:bg-gray-50' }}
                bg-white p-5 transition-colors duration-200 group
                shadow-sm hover:shadow-md">
        <h3 class="font-bold text-gray-800 text-sm group-hover:{{ $catText[$cat->slug] ?? 'text-gray-600' }} 
                   transition-colors">
          {{ $cat->name }}
        </h3>
        <p class="text-xs text-gray-400 mt-1">
          {{ $cat->posts_count }} artikel
        </p>
      </a>
      @endforeach
    </div>
  </section>

@endsection