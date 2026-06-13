<!-- resources/views/public/posts/show.blade.php -->
@extends('layouts.app')
@section('title', $post->title)
@section('description', $post->excerpt)

@section('content')

  {{-- Breadcrumb --}}
  <div class="bg-gray-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-3">
      <nav class="flex items-center gap-2 text-xs text-gray-400">
        <a href="{{ route('home') }}" 
           class="hover:text-primary-600 transition-colors">Beranda</a>
        <span>/</span>
        <a href="{{ route('posts.index') }}" 
           class="hover:text-primary-600 transition-colors">Berita</a>
        <span>/</span>
        <a href="{{ route('category.show', $post->category->slug) }}"
           class="hover:text-primary-600 transition-colors">
          {{ $post->category->name }}
        </a>
        <span>/</span>
        <span class="text-gray-600 truncate max-w-xs">{{ $post->title }}</span>
      </nav>
    </div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
    <div class="flex flex-col lg:flex-row gap-12">

      {{-- Artikel --}}
      <article class="flex-1 min-w-0">

        {{-- Kategori --}}
        <span class="text-xs font-bold text-primary-600 uppercase tracking-widest">
          {{ $post->category->name }}
        </span>

        {{-- Judul --}}
        <h1 class="text-3xl font-black text-gray-900 leading-tight mt-2 mb-4">
          {{ $post->title }}
        </h1>

        {{-- Meta --}}
        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 
                    pb-5 mb-6 border-b border-gray-200">
          <div class="flex items-center gap-2">
            <div class="w-7 h-7 bg-primary-600 rounded-full flex items-center 
                        justify-center text-white font-bold text-xs">
              {{ strtoupper(substr($post->author->name, 0, 1)) }}
            </div>
            <span class="font-medium text-gray-700">{{ $post->author->name }}</span>
          </div>
          <div class="flex items-center gap-1.5 text-gray-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" 
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 
                       00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            {{ $post->published_at?->translatedFormat('d F Y') 
               ?? $post->created_at->translatedFormat('d F Y') }}
          </div>
        </div>

        {{-- Gambar --}}
        @if($post->image)
        <img src="{{ $post->image }}"
             alt="{{ $post->title }}"
             class="w-full max-h-96 object-cover mb-8"/>
        @endif

        {{-- Konten --}}
        <div class="prose prose-lg max-w-none
                    prose-headings:font-bold prose-headings:text-gray-900
                    prose-p:text-gray-600 prose-p:leading-relaxed
                    prose-a:text-primary-600 prose-a:no-underline 
                    hover:prose-a:underline">
          {!! $post->content !!}
        </div>

        {{-- Kembali --}}
        <div class="mt-10 pt-6 border-t border-gray-200">
          <a href="{{ route('posts.index') }}"
             class="text-sm font-semibold text-primary-600 
                    hover:text-primary-700 transition-colors
                    flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" 
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" 
                    stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Berita
          </a>
        </div>
      </article>

      {{-- Sidebar --}}
      <aside class="w-full lg:w-64 shrink-0 space-y-8">

        {{-- Berita Terkait --}}
        @if($relatedPosts->count() > 0)
        <div>
          <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest 
                     mb-3 pb-2 border-b-2 border-primary-600">
            Berita Terkait
          </h3>
          <div class="space-y-0">
            @foreach($relatedPosts as $related)
            <a href="{{ route('posts.show', $related->slug) }}"
               class="flex gap-3 py-4 border-b border-gray-100 group">
              @if($related->image)
                <img src="{{ $related->image }}"
                     alt="{{ $related->title }}"
                     class="w-16 h-14 object-cover shrink-0"/>
              @else
                <div class="w-16 h-14 bg-gray-100 shrink-0"></div>
              @endif
              <div>
                <h4 class="text-xs font-semibold text-gray-800 leading-snug 
                           line-clamp-3 group-hover:text-primary-700 
                           transition-colors">
                  {{ $related->title }}
                </h4>
                <p class="text-xs text-gray-400 mt-1">
                  {{ $related->published_at?->format('d M Y') 
                     ?? $related->created_at->format('d M Y') }}
                </p>
              </div>
            </a>
            @endforeach
          </div>
        </div>
        @endif

        {{-- Semua Kategori --}}
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
                        border-b border-gray-100 transition-colors
                        {{ $cat->id === $post->category_id 
                           ? 'text-primary-700 font-bold' 
                           : 'text-gray-600 hover:text-primary-700' }}">
                <span>{{ $cat->name }}</span>
                <span class="text-xs text-gray-400">{{ $cat->posts_count }}</span>
              </a>
            </li>
            @endforeach
          </ul>
        </div>

      </aside>
    </div>
  </div>

@endsection