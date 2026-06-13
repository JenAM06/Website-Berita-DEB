<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data dan aktivitas terbaru')

@section('content')

  {{-- ── STAT CARDS ── --}}
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    @foreach([
      ['Total Berita',     $stats['total_posts'],      '📰', 'from-blue-500 to-blue-600'],
      ['Dipublikasikan',   $stats['published_posts'],  '✅', 'from-green-500 to-green-600'],
      ['Draft',            $stats['draft_posts'],      '📝', 'from-yellow-500 to-yellow-600'],
      ['Total Kategori',   $stats['total_categories'], '🏷️', 'from-purple-500 to-purple-600'],
    ] as [$label, $value, $icon, $gradient])
    <div class="bg-gradient-to-br {{ $gradient }} rounded-2xl p-5 text-white shadow-sm">
      <div class="flex items-center justify-between mb-3">
        <span class="text-2xl">{{ $icon }}</span>
        <span class="text-3xl font-bold">{{ $value }}</span>
      </div>
      <p class="text-sm opacity-90 font-medium">{{ $label }}</p>
    </div>
    @endforeach

  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ── BERITA TERBARU ── --}}
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100">
      <div class="flex items-center justify-between p-5 border-b border-gray-100">
        <h2 class="font-bold text-gray-800">Berita Terbaru</h2>
        <a href="{{ route('admin.posts.index') }}"
           class="text-sm text-primary-600 hover:text-primary-700 font-medium">
          Lihat Semua →
        </a>
      </div>
      <div class="divide-y divide-gray-50">
        @forelse($recentPosts as $post)
        <div class="flex items-start gap-4 p-5 hover:bg-gray-50 transition-colors">

          {{-- Gambar Thumbnail --}}
          @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}"
                 alt="{{ $post->title }}"
                 class="w-14 h-14 rounded-xl object-cover shrink-0"/>
          @else
            <div class="w-14 h-14 rounded-xl bg-primary-100 flex items-center 
                        justify-center shrink-0">
              <span class="text-2xl">📰</span>
            </div>
          @endif

          <div class="flex-1 min-w-0">
            <h3 class="font-semibold text-gray-800 text-sm leading-snug 
                       truncate mb-1">
              {{ $post->title }}
            </h3>
            <div class="flex items-center gap-2 flex-wrap">
              <span class="badge 
                {{ $post->status === 'published' 
                   ? 'bg-green-100 text-green-700' 
                   : 'bg-yellow-100 text-yellow-700' }}">
                {{ $post->status === 'published' ? 'Publik' : 'Draft' }}
              </span>
              <span class="badge bg-primary-100 text-primary-700">
                {{ $post->category->name }}
              </span>
              <span class="text-xs text-gray-400">
                {{ $post->created_at->diffForHumans() }}
              </span>
            </div>
          </div>

          {{-- Aksi --}}
          <div class="flex items-center gap-1 shrink-0">
            <a href="{{ route('admin.posts.edit', $post) }}"
               class="p-2 text-gray-400 hover:text-primary-600 
                      hover:bg-primary-50 rounded-lg transition-colors"
               title="Edit">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" 
                   viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                         m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
              </svg>
            </a>
          </div>
        </div>
        @empty
        <div class="p-8 text-center text-gray-400 text-sm">
          Belum ada berita.
        </div>
        @endforelse
      </div>
    </div>

    {{-- ── STATISTIK KATEGORI ── --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
      <div class="p-5 border-b border-gray-100">
        <h2 class="font-bold text-gray-800">Berita per Kategori</h2>
      </div>
      <div class="p-5 space-y-4">
        @foreach($categoryStats as $cat)
        @php
          $maxCount = $categoryStats->max('posts_count');
          $pct = $maxCount > 0 ? ($cat->posts_count / $maxCount * 100) : 0;
          $colors = [
            'energi'     => 'bg-yellow-400',
            'lingkungan' => 'bg-green-500',
            'edukasi'    => 'bg-blue-500',
            'ekonomi'    => 'bg-purple-500',
            'wisata'     => 'bg-orange-400',
          ];
          $bar = $colors[$cat->slug] ?? 'bg-gray-400';
        @endphp
        <div>
          <div class="flex items-center justify-between mb-1">
            <span class="text-sm font-medium text-gray-700">{{ $cat->name }}</span>
            <span class="text-sm text-gray-500">{{ $cat->posts_count }}</span>
          </div>
          <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
            <div class="{{ $bar }} h-2 rounded-full transition-all duration-500"
                 style="width: {{ $pct }}%"></div>
          </div>
        </div>
        @endforeach
      </div>

      {{-- Quick Actions --}}
      <div class="p-5 pt-0 space-y-2">
        <p class="text-xs font-semibold text-gray-400 uppercase mb-3">
          Aksi Cepat
        </p>
        <a href="{{ route('admin.posts.create') }}"
           class="btn-primary w-full justify-center text-sm">
          + Tambah Berita Baru
        </a>
        <a href="{{ route('admin.categories.create') }}"
           class="btn-outline w-full justify-center text-sm">
          + Tambah Kategori
        </a>
      </div>
    </div>

  </div>

@endsection