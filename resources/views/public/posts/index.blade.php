<!-- resources/views/public/posts/index.blade.php -->
@extends('layouts.app')
@section('title', 'Semua Berita')

@section('content')

  {{-- Header --}}
  <div class="border-b border-gray-200 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 py-8">
      <div class="section-divider"></div>
      <h1 class="text-3xl font-black text-gray-900">Berita</h1>
      <p class="text-gray-500 text-sm mt-1">
        Informasi terkini seputar Program DEB Sawah Betapus
      </p>
    </div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
    <div class="flex flex-col lg:flex-row gap-10">

      {{-- Konten Utama --}}
      <div class="flex-1">

        {{-- Search --}}
        <form action="{{ route('posts.index') }}" method="GET" class="mb-8">
          <div class="flex gap-2">
            <div class="relative flex-1">
              <input type="text" name="search"
                     value="{{ $search }}"
                     placeholder="Cari berita..."
                     class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-300
                            focus:outline-none focus:border-primary-500 
                            focus:ring-1 focus:ring-primary-500 bg-white"/>
              <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400"
                   fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
            </div>
            <button type="submit" class="btn-primary">Cari</button>
            @if($search)
            <a href="{{ route('posts.index') }}"
               class="px-4 py-2.5 text-sm border border-gray-300 text-gray-500
                      hover:bg-gray-50 transition-colors">
              Reset
            </a>
            @endif
          </div>
          @if($search)
          <p class="text-sm text-gray-500 mt-2">
            Menampilkan hasil untuk 
            <strong class="text-gray-800">"{{ $search }}"</strong> 
            — {{ $posts->total() }} berita ditemukan
          </p>
          @endif
        </form>

        {{-- Daftar Berita --}}
        @if($posts->count() > 0)
        <div class="space-y-0">
          @foreach($posts as $index => $post)

          @if($index === 0 && !$search)
          {{-- Post pertama: besar --}}
          <a href="{{ route('posts.show', $post->slug) }}"
             class="flex flex-col sm:flex-row gap-6 pb-8 mb-8 
                    border-b border-gray-200 group">
            @if($post->image)
              <img src="{{ asset('storage/' . $post->image) }}"
                   alt="{{ $post->title }}"
                   class="w-full sm:w-64 h-44 object-cover shrink-0"/>
            @else
              <div class="w-full sm:w-64 h-44 bg-gray-100 shrink-0 
                          flex items-center justify-center">
                <svg class="w-10 h-10 text-gray-300" fill="none" 
                     stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" 
                        stroke-width="1.5"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16"/>
                </svg>
              </div>
            @endif
            <div class="flex-1">
              <span class="text-xs font-bold text-primary-600 uppercase 
                           tracking-widest">
                {{ $post->category->name }}
              </span>
              <h2 class="text-xl font-bold text-gray-900 mt-1 leading-snug 
                         group-hover:text-primary-700 transition-colors">
                {{ $post->title }}
              </h2>
              <p class="text-gray-500 text-sm mt-2 leading-relaxed line-clamp-2">
                {{ $post->excerpt }}
              </p>
              <div class="flex items-center gap-4 mt-3 text-xs text-gray-400">
                <span>{{ $post->author->name }}</span>
                <span>
                  {{ $post->published_at?->format('d M Y') 
                     ?? $post->created_at->format('d M Y') }}
                </span>
              </div>
            </div>
          </a>

          @else
          {{-- Post lainnya: horizontal kecil --}}
          <a href="{{ route('posts.show', $post->slug) }}"
             class="flex gap-4 py-5 border-b border-gray-100 group">
            @if($post->image)
              <img src="{{ asset('storage/' . $post->image) }}"
                   alt="{{ $post->title }}"
                   class="w-24 h-18 object-cover shrink-0"/>
            @else
              <div class="w-24 h-18 bg-gray-100 shrink-0"></div>
            @endif
            <div class="flex-1 min-w-0">
              <span class="text-xs font-bold text-primary-600 uppercase 
                           tracking-widest">
                {{ $post->category->name }}
              </span>
              <h3 class="font-semibold text-gray-800 text-sm leading-snug mt-0.5 
                         line-clamp-2 group-hover:text-primary-700 transition-colors">
                {{ $post->title }}
              </h3>
              <p class="text-xs text-gray-400 mt-1">
                {{ $post->published_at?->format('d M Y') 
                   ?? $post->created_at->format('d M Y') }}
              </p>
            </div>
          </a>
          @endif

          @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8 pt-4">
          {{ $posts->appends(request()->query())->links() }}
        </div>

        @else
        <div class="py-20 text-center border border-gray-200">
          <p class="text-gray-400 font-medium">Berita tidak ditemukan.</p>
          <a href="{{ route('posts.index') }}"
             class="text-primary-600 text-sm mt-2 inline-block hover:underline">
            Lihat semua berita
          </a>
        </div>
        @endif
      </div>

      {{-- Sidebar --}}
      <aside class="w-full lg:w-64 shrink-0 space-y-8">

        {{-- Kategori --}}
        <div>
          <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest 
                     mb-3 pb-2 border-b-2 border-primary-600">
            Kategori
          </h3>
          <ul class="space-y-0">
            @foreach($categories as $cat)
            <li>
              <a href="{{ route('category.show', $cat->slug) }}"
                 class="flex items-center justify-between py-2.5 text-sm 
                        text-gray-700 hover:text-primary-700 border-b 
                        border-gray-100 transition-colors group">
                <span class="group-hover:font-semibold transition-all">
                  {{ $cat->name }}
                </span>
                <span class="text-xs text-gray-400">
                  {{ $cat->posts_count }}
                </span>
              </a>
            </li>
            @endforeach
          </ul>
        </div>

        {{-- Tentang --}}
        <div class="bg-primary-700 p-5 text-white">
          <h3 class="font-bold text-sm mb-2">Tentang EcoBetapus</h3>
          <p class="text-primary-200 text-xs leading-relaxed mb-4">
            Portal informasi Program Desa Energi Berdikari berbasis PLTS, 
            Bank Sampah, dan pemberdayaan masyarakat di Sawah Betapus, Samarinda.
          </p>
          <a href="{{ route('about') }}"
             class="text-xs font-semibold text-white border border-white 
                    px-4 py-2 inline-block hover:bg-white 
                    hover:text-primary-700 transition-colors">
            Selengkapnya
          </a>
        </div>

      </aside>
    </div>
  </div>

@endsection