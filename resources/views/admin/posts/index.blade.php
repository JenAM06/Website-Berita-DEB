<!-- resources/views/admin/posts/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Manajemen Berita')
@section('page-title', 'Manajemen Berita')
@section('page-subtitle', 'Kelola seluruh berita yang dipublikasikan')

@section('content')

  {{-- Header Aksi --}}
  <div class="flex flex-col sm:flex-row sm:items-center justify-between 
              gap-4 mb-6">
    <form action="{{ route('admin.posts.index') }}" method="GET"
          class="flex gap-2 flex-1 max-w-lg">
      <div class="relative flex-1">
        <input type="text" name="search"
               value="{{ $search }}"
               placeholder="Cari judul atau kategori..."
               class="w-full pl-9 pr-4 py-2.5 text-sm border border-gray-200 
                      rounded-xl focus:outline-none focus:ring-2 
                      focus:ring-primary-500 bg-white"/>
        <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </div>
      {{-- Filter Status --}}
      <select name="status"
              class="text-sm border border-gray-200 rounded-xl px-3 py-2.5 
                     focus:outline-none focus:ring-2 focus:ring-primary-500 
                     bg-white text-gray-600"
              onchange="this.form.submit()">
        <option value="">Semua Status</option>
        <option value="published" {{ $status === 'published' ? 'selected' : '' }}>
          Publik
        </option>
        <option value="draft" {{ $status === 'draft' ? 'selected' : '' }}>
          Draft
        </option>
      </select>
      <button type="submit" class="btn-primary text-sm">Cari</button>
      @if($search || $status)
        <a href="{{ route('admin.posts.index') }}"
           class="px-4 py-2.5 text-sm text-gray-500 border border-gray-200 
                  rounded-xl bg-white hover:bg-gray-50 transition-colors">
          Reset
        </a>
      @endif
    </form>

    <a href="{{ route('admin.posts.create') }}" class="btn-primary shrink-0">
      + Tambah Berita
    </a>
  </div>

  {{-- Tabel --}}
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="bg-gray-50 border-b border-gray-100">
            <th class="text-left px-5 py-3.5 text-xs font-semibold 
                       text-gray-500 uppercase tracking-wider">Berita</th>
            <th class="text-left px-5 py-3.5 text-xs font-semibold 
                       text-gray-500 uppercase tracking-wider hidden md:table-cell">
              Kategori
            </th>
            <th class="text-left px-5 py-3.5 text-xs font-semibold 
                       text-gray-500 uppercase tracking-wider hidden sm:table-cell">
              Status
            </th>
            <th class="text-left px-5 py-3.5 text-xs font-semibold 
                       text-gray-500 uppercase tracking-wider hidden lg:table-cell">
              Tanggal
            </th>
            <th class="text-right px-5 py-3.5 text-xs font-semibold 
                       text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
          @forelse($posts as $post)
          <tr class="hover:bg-gray-50 transition-colors">

            {{-- Berita --}}
            <td class="px-5 py-4">
              <div class="flex items-center gap-3">
                @if($post->image)
                  <img src="{{ $post->image }}"
                       alt="{{ $post->title }}"
                       class="w-12 h-12 rounded-xl object-cover shrink-0"/>
                @else
                  <div class="w-12 h-12 rounded-xl bg-primary-100 
                              flex items-center justify-center shrink-0">
                    <span class="text-xl">📰</span>
                  </div>
                @endif
                <div class="min-w-0">
                  <p class="font-semibold text-gray-800 text-sm truncate 
                             max-w-xs">
                    {{ $post->title }}
                  </p>
                  <p class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">
                    {{ $post->excerpt ?? 'Tidak ada ringkasan' }}
                  </p>
                </div>
              </div>
            </td>

            {{-- Kategori --}}
            <td class="px-5 py-4 hidden md:table-cell">
              <span class="badge bg-primary-100 text-primary-700">
                {{ $post->category->name }}
              </span>
            </td>

            {{-- Status --}}
            <td class="px-5 py-4 hidden sm:table-cell">
              <span class="badge 
                {{ $post->status === 'published' 
                   ? 'bg-green-100 text-green-700' 
                   : 'bg-yellow-100 text-yellow-700' }}">
                {{ $post->status === 'published' ? '✓ Publik' : '✎ Draft' }}
              </span>
            </td>

            {{-- Tanggal --}}
            <td class="px-5 py-4 hidden lg:table-cell">
              <span class="text-sm text-gray-500">
                {{ $post->published_at?->format('d M Y') 
                   ?? $post->created_at->format('d M Y') }}
              </span>
            </td>

            {{-- Aksi --}}
            <td class="px-5 py-4">
              <div class="flex items-center justify-end gap-1">
                {{-- Lihat --}}
                <a href="{{ route('posts.show', $post->slug) }}" target="_blank"
                   class="p-2 text-gray-400 hover:text-blue-600 
                          hover:bg-blue-50 rounded-lg transition-colors"
                   title="Lihat di Website">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" 
                       viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 
                             9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                </a>
                {{-- Edit --}}
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
                {{-- Hapus --}}
                <form action="{{ route('admin.posts.destroy', $post) }}" 
                      method="POST"
                      onsubmit="return confirm('Hapus berita ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          class="p-2 text-gray-400 hover:text-red-600 
                                 hover:bg-red-50 rounded-lg transition-colors"
                          title="Hapus">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" 
                         viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" 
                            stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 
                               01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 
                               1 0 00-1 1v3M4 7h16"/>
                    </svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="px-5 py-16 text-center text-gray-400">
              <div class="text-4xl mb-3">📭</div>
              <p class="font-medium">Belum ada berita.</p>
              <a href="{{ route('admin.posts.create') }}"
                 class="text-primary-600 text-sm hover:underline mt-1 
                        inline-block">
                Tambah berita pertama →
              </a>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    @if($posts->hasPages())
    <div class="px-5 py-4 border-t border-gray-100">
      {{ $posts->appends(request()->query())->links() }}
    </div>
    @endif
  </div>

@endsection