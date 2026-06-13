<!-- resources/views/admin/categories/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Manajemen Kategori')
@section('page-title', 'Manajemen Kategori')
@section('page-subtitle', 'Kelola kategori berita')

@section('content')

  <div class="flex flex-col sm:flex-row sm:items-center justify-between 
              gap-4 mb-6">
    <form action="{{ route('admin.categories.index') }}" method="GET"
          class="flex gap-2 flex-1 max-w-sm">
      <div class="relative flex-1">
        <input type="text" name="search"
               value="{{ $search }}"
               placeholder="Cari kategori..."
               class="w-full pl-9 pr-4 py-2.5 text-sm border border-gray-200 
                      rounded-xl focus:outline-none focus:ring-2 
                      focus:ring-primary-500 bg-white"/>
        <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </div>
      <button type="submit" class="btn-primary text-sm">Cari</button>
    </form>
    <a href="{{ route('admin.categories.create') }}" class="btn-primary shrink-0">
      + Tambah Kategori
    </a>
  </div>

  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full">
      <thead>
        <tr class="bg-gray-50 border-b border-gray-100">
          <th class="text-left px-5 py-3.5 text-xs font-semibold 
                     text-gray-500 uppercase tracking-wider">Nama</th>
          <th class="text-left px-5 py-3.5 text-xs font-semibold 
                     text-gray-500 uppercase tracking-wider hidden md:table-cell">
            Deskripsi
          </th>
          <th class="text-left px-5 py-3.5 text-xs font-semibold 
                     text-gray-500 uppercase tracking-wider">Berita</th>
          <th class="text-right px-5 py-3.5 text-xs font-semibold 
                     text-gray-500 uppercase tracking-wider">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-50">
        @forelse($categories as $category)
        <tr class="hover:bg-gray-50 transition-colors">
          <td class="px-5 py-4">
            <div>
              <p class="font-semibold text-gray-800">{{ $category->name }}</p>
              <p class="text-xs text-gray-400 font-mono mt-0.5">
                /kategori/{{ $category->slug }}
              </p>
            </div>
          </td>
          <td class="px-5 py-4 hidden md:table-cell">
            <p class="text-sm text-gray-500 truncate max-w-xs">
              {{ $category->description ?? '—' }}
            </p>
          </td>
          <td class="px-5 py-4">
            <span class="badge bg-primary-100 text-primary-700">
              {{ $category->posts_count }} berita
            </span>
          </td>
          <td class="px-5 py-4">
            <div class="flex items-center justify-end gap-1">
              <a href="{{ route('admin.categories.edit', $category) }}"
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
              <form action="{{ route('admin.categories.destroy', $category) }}" 
                    method="POST"
                    onsubmit="return confirm('Hapus kategori {{ $category->name }}?')">
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
          <td colspan="4" class="px-5 py-12 text-center text-gray-400">
            Belum ada kategori.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
    @if($categories->hasPages())
    <div class="px-5 py-4 border-t border-gray-100">
      {{ $categories->appends(request()->query())->links() }}
    </div>
    @endif
  </div>

@endsection