<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data dan aktivitas terbaru')

@section('content')

  {{-- Stat Cards --}}
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    <div class="bg-blue-600 rounded-xl p-5 text-white">
      <p class="text-xs font-semibold text-blue-200 uppercase tracking-wider mb-2">
        Total Berita
      </p>
      <p class="text-3xl font-black">{{ $stats['total_posts'] }}</p>
    </div>

    <div class="bg-green-600 rounded-xl p-5 text-white">
      <p class="text-xs font-semibold text-green-200 uppercase tracking-wider mb-2">
        Dipublikasikan
      </p>
      <p class="text-3xl font-black">{{ $stats['published_posts'] }}</p>
    </div>

    <div class="bg-yellow-500 rounded-xl p-5 text-white">
      <p class="text-xs font-semibold text-yellow-100 uppercase tracking-wider mb-2">
        Draft
      </p>
      <p class="text-3xl font-black">{{ $stats['draft_posts'] }}</p>
    </div>

    <div class="bg-purple-600 rounded-xl p-5 text-white">
      <p class="text-xs font-semibold text-purple-200 uppercase tracking-wider mb-2">
        Total Kategori
      </p>
      <p class="text-3xl font-black">{{ $stats['total_categories'] }}</p>
    </div>

  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Berita Terbaru --}}
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200">
      <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
        <h2 class="font-bold text-gray-800 text-sm">Berita Terbaru</h2>
        <a href="{{ route('admin.posts.index') }}"
           class="text-xs text-primary-600 hover:text-primary-700 font-semibold">
          Lihat Semua
        </a>
      </div>
      <div class="divide-y divide-gray-50">
        @forelse($recentPosts as $post)
        <div class="flex items-start gap-4 px-5 py-4 hover:bg-gray-50 
                    transition-colors">
          @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}"
                 alt="{{ $post->title }}"
                 class="w-12 h-12 rounded-lg object-cover shrink-0"/>
          @else
            <div class="w-12 h-12 rounded-lg bg-gray-100 shrink-0 
                        flex items-center justify-center">
              <svg class="w-5 h-5 text-gray-400" fill="none" 
                   stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      stroke-width="1.5"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586
                         a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 
                         01-2 2z"/>
            </svg>
            </div>
          @endif

          <div class="flex-1 min-w-0">
            <p class="font-semibold text-gray-800 text-sm truncate">
              {{ $post->title }}
            </p>
            <div class="flex items-center gap-2 mt-1 flex-wrap">
              <span class="text-xs px-2 py-0.5 rounded font-medium
                {{ $post->status === 'published'
                   ? 'bg-green-100 text-green-700'
                   : 'bg-yellow-100 text-yellow-700' }}">
                {{ $post->status === 'published' ? 'Publik' : 'Draft' }}
              </span>
              <span class="text-xs px-2 py-0.5 bg-gray-100 text-gray-600 rounded">
                {{ $post->category->name }}
              </span>
              <span class="text-xs text-gray-400">
                {{ $post->created_at->diffForHumans() }}
              </span>
            </div>
          </div>

          <a href="{{ route('admin.posts.edit', $post) }}"
             class="p-1.5 text-gray-400 hover:text-primary-600
                    hover:bg-primary-50 rounded transition-colors shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" 
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                       m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
          </a>
        </div>
        @empty
        <div class="px-5 py-10 text-center text-gray-400 text-sm">
          Belum ada berita.
        </div>
        @endforelse
      </div>
    </div>

    {{-- Sidebar Kanan --}}
    <div class="space-y-5">

      {{-- Berita per Kategori --}}
      <div class="bg-white rounded-xl border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100">
          <h2 class="font-bold text-gray-800 text-sm">Berita per Kategori</h2>
        </div>
        <div class="p-5 space-y-4">
          @foreach($categoryStats as $cat)
          @php
            $maxCount = $categoryStats->max('posts_count');
            $pct = $maxCount > 0 ? ($cat->posts_count / $maxCount * 100) : 0;
            $barColors = [
              'energi'     => 'bg-yellow-400',
              'lingkungan' => 'bg-green-500',
              'edukasi'    => 'bg-blue-500',
              'ekonomi'    => 'bg-purple-500',
              'wisata'     => 'bg-orange-400',
            ];
            $bar = $barColors[$cat->slug] ?? 'bg-gray-400';
          @endphp
          <div>
            <div class="flex justify-between mb-1">
              <span class="text-xs font-medium text-gray-700">
                {{ $cat->name }}
              </span>
              <span class="text-xs text-gray-500">{{ $cat->posts_count }}</span>
            </div>
            <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
              <div class="{{ $bar }} h-1.5 rounded-full"
                   style="width: {{ $pct }}%"></div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      {{-- Aksi Cepat --}}
      <div class="bg-white rounded-xl border border-gray-200 p-5">
        <h3 class="font-bold text-gray-800 text-sm mb-4">Aksi Cepat</h3>
        <div class="space-y-2">
          <a href="{{ route('admin.posts.create') }}"
             class="block w-full text-center bg-primary-600 hover:bg-primary-700
                    text-white font-semibold py-2.5 px-4 rounded-lg text-sm
                    transition-colors">
            Tambah Berita Baru
          </a>
          <a href="{{ route('admin.categories.create') }}"
             class="block w-full text-center border border-primary-600
                    text-primary-600 hover:bg-primary-600 hover:text-white
                    font-semibold py-2.5 px-4 rounded-lg text-sm
                    transition-colors">
            Tambah Kategori
          </a>
        </div>
      </div>

    </div>
  </div>

@endsection