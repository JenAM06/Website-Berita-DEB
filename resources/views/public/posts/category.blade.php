<!-- resources/views/public/posts/category.blade.php -->
@extends('layouts.app')

@section('title', 'Kategori: ' . $category->name)

@section('content')

{{-- Header Kategori --}}
<div class="bg-gradient-to-br from-primary-700 to-primary-600 text-white py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <a href="{{ route('posts.index') }}"
       class="text-primary-200 hover:text-white text-sm mb-3 
              inline-flex items-center gap-1 transition-colors">
      ← Semua Berita
    </a>
    <h1 class="text-3xl font-bold">{{ $category->name }}</h1>
    @if($category->description)
    <p class="text-primary-200 mt-2">{{ $category->description }}</p>
    @endif
    <p class="text-primary-300 text-sm mt-2">
      {{ $posts->total() }} artikel tersedia
    </p>
  </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
  <div class="flex flex-col lg:flex-row gap-8">

    <div class="flex-1">
      {{-- Search dalam kategori --}}
      <form action="{{ route('category.show', $category->slug) }}" 
            method="GET" class="mb-6">
        <div class="flex gap-2">
          <div class="relative flex-1">
            <input type="text" name="search"
                   value="{{ $search }}"
                   placeholder="Cari di {{ $category->name }}..."
                   class="w-full pl-10 pr-4 py-3 border border-gray-200 
                          rounded-xl focus:outline-none focus:ring-2 
                          focus:ring-primary-500 bg-white text-sm"/>
            <svg class="absolute left-3 top-3.5 w-4 h-4 text-gray-400"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" 
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </div>
          <button type="submit" class="btn-primary">Cari</button>
        </div>
      </form>

      @if($posts->count() > 0)
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @foreach($posts as $post)
        <article class="card overflow-hidden group flex flex-col">
          <a href="{{ route('posts.show', $post->slug) }}" class="block">
            @if($post->image)
              <img src="{{ $post->image }}"
                   alt="{{ $post->title }}"
                   class="w-full h-44 object-cover group-hover:scale-105 
                          transition-transform duration-300"/>
            @else
              <div class="w-full h-44 bg-gradient-to-br from-primary-100 
                          to-primary-200 flex items-center justify-center">
                <span class="text-5xl">
                  @php
                    $icons = ['energi'=>'⚡','lingkungan'=>'🌿',
                              'edukasi'=>'📚','ekonomi'=>'💰','wisata'=>'🏞️'];
                    echo $icons[$category->slug] ?? '📰';
                  @endphp
                </span>
              </div>
            @endif
          </a>
          <div class="p-5 flex flex-col flex-1">
            <a href="{{ route('posts.show', $post->slug) }}">
              <h2 class="font-bold text-gray-800 leading-snug mb-2 
                         hover:text-primary-700 transition-colors line-clamp-2">
                {{ $post->title }}
              </h2>
            </a>
            <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 
                      flex-1 mb-4">
              {{ $post->excerpt }}
            </p>
            <div class="flex items-center justify-between text-xs text-gray-400 
                        pt-3 border-t border-gray-100">
              <span>✍️ {{ $post->author->name }}</span>
              <span>
                {{ $post->published_at?->format('d M Y') 
                   ?? $post->created_at->format('d M Y') }}
              </span>
            </div>
          </div>
        </article>
        @endforeach
      </div>
      <div class="mt-8">
        {{ $posts->appends(request()->query())->links() }}
      </div>
      @else
      <div class="text-center py-16 text-gray-400">
        <p class="font-medium">Belum ada berita di kategori ini.</p>
      </div>
      @endif
    </div>

    {{-- Sidebar --}}
    <aside class="w-full lg:w-72 shrink-0">
      <div class="card p-5">
        <h3 class="font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">
          Kategori Lainnya
        </h3>
        <ul class="space-y-2">
          @foreach($categories as $cat)
          <li>
            <a href="{{ route('category.show', $cat->slug) }}"
               class="flex items-center justify-between py-1.5 text-sm 
                      transition-colors
                      {{ $cat->id === $category->id 
                         ? 'text-primary-700 font-semibold' 
                         : 'text-gray-600 hover:text-primary-700' }}">
              <span>{{ $cat->name }}</span>
              <span class="badge 
                {{ $cat->id === $category->id 
                   ? 'bg-primary-100 text-primary-700' 
                   : 'bg-gray-100 text-gray-500' }}">
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