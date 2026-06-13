<!-- resources/views/public/posts/show.blade.php -->
@extends('layouts.app')

@section('title', $post->title)
@section('description', $post->excerpt)

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

  {{-- Breadcrumb --}}
  <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
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

  <div class="flex flex-col lg:flex-row gap-8">

    {{-- ── ARTIKEL UTAMA ── --}}
    <article class="flex-1">

      {{-- Kategori Badge --}}
      <a href="{{ route('category.show', $post->category->slug) }}"
         class="badge bg-primary-100 text-primary-700 
                hover:bg-primary-200 mb-4 inline-block">
        {{ $post->category->name }}
      </a>

      {{-- Judul --}}
      <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 
                 leading-tight mb-4">
        {{ $post->title }}
      </h1>

      {{-- Meta Penulis + Tanggal --}}
      <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 
                  mb-6 pb-6 border-b border-gray-100">
        <span class="flex items-center gap-2">
          <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center 
                      justify-center text-white font-bold text-xs">
            {{ strtoupper(substr($post->author->name, 0, 1)) }}
          </div>
          <span class="font-medium text-gray-700">{{ $post->author->name }}</span>
        </span>
        <span class="flex items-center gap-1">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" 
               viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 
                     00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
          {{ $post->published_at?->translatedFormat('d F Y') 
             ?? $post->created_at->translatedFormat('d F Y') }}
        </span>
      </div>

      {{-- Gambar Utama --}}
      @if($post->image)
      <img src="{{ asset('storage/' . $post->image) }}"
           alt="{{ $post->title }}"
           class="w-full max-h-96 object-cover rounded-2xl mb-8 shadow-sm"/>
      @endif

      {{-- Isi Berita --}}
      <div class="prose prose-lg prose-primary max-w-none
                  prose-headings:text-gray-800 prose-p:text-gray-600
                  prose-p:leading-relaxed prose-a:text-primary-600">
        {!! $post->content !!}
      </div>

      {{-- Tombol Kembali --}}
      <div class="mt-10 pt-6 border-t border-gray-100">
        <a href="{{ route('posts.index') }}"
           class="btn-outline">
          ← Kembali ke Daftar Berita
        </a>
      </div>
    </article>

    {{-- ── SIDEBAR ── --}}
    <aside class="w-full lg:w-72 shrink-0 space-y-6">

      {{-- Berita Terkait --}}
      @if($relatedPosts->count() > 0)
      <div class="card p-5">
        <h3 class="font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">
          Berita Terkait
        </h3>
        <div class="space-y-4">
          @foreach($relatedPosts as $related)
          <a href="{{ route('posts.show', $related->slug) }}" 
             class="flex gap-3 group">
            @if($related->image)
              <img src="{{ asset('storage/' . $related->image) }}"
                   alt="{{ $related->title }}"
                   class="w-20 h-16 object-cover rounded-lg shrink-0"/>
            @else
              <div class="w-20 h-16 bg-primary-100 rounded-lg shrink-0 
                          flex items-center justify-center">
                <span class="text-primary-400 text-xl">📰</span>
              </div>
            @endif
            <div>
              <h4 class="text-sm font-semibold text-gray-700 
                         group-hover:text-primary-700 transition-colors 
                         line-clamp-2 leading-snug">
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
      <div class="card p-5">
        <h3 class="font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">
          Semua Kategori
        </h3>
        <ul class="space-y-2">
          @foreach($categories as $cat)
          <li>
            <a href="{{ route('category.show', $cat->slug) }}"
               class="flex items-center justify-between py-1.5 text-sm 
                      text-gray-600 hover:text-primary-700 transition-colors
                      {{ $cat->id === $post->category_id 
                         ? 'font-semibold text-primary-700' : '' }}">
              <span>{{ $cat->name }}</span>
              <span class="badge bg-gray-100 text-gray-500 text-xs">
                {{ $cat->posts_count }}
              </span>
            </a>
          </li>
          @endforeach
        </ul>
      </div>

    </aside>
  </div>
</div>

@endsection