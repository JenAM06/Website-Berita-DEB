<!-- resources/views/admin/categories/_form.blade.php -->
<div class="max-w-xl">
  <form action="{{ $action }}" method="POST">
    @csrf
    @if($method !== 'POST') @method($method) @endif

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 
                space-y-5">

      {{-- Nama --}}
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">
          Nama Kategori <span class="text-red-500">*</span>
        </label>
        <input type="text" name="name"
               value="{{ old('name', $category?->name) }}"
               placeholder="Contoh: Energi"
               class="w-full px-4 py-3 border rounded-xl text-sm 
                      focus:outline-none focus:ring-2 focus:ring-primary-500
                      @error('name') border-red-400 bg-red-50 
                      @else border-gray-200 @enderror"/>
        @error('name')
          <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Deskripsi --}}
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">
          Deskripsi <span class="font-normal text-gray-400 ml-1">(opsional)</span>
        </label>
        <textarea name="description" rows="3"
                  placeholder="Deskripsi singkat kategori ini..."
                  class="w-full px-4 py-3 border border-gray-200 rounded-xl 
                         text-sm focus:outline-none focus:ring-2 
                         focus:ring-primary-500 resize-none">{{ old('description', $category?->description) }}</textarea>
      </div>

      {{-- Tombol --}}
      <div class="flex gap-3 pt-2">
        <button type="submit" class="btn-primary">
          {{ $category ? '💾 Simpan Perubahan' : '+ Tambah Kategori' }}
        </button>
        <a href="{{ route('admin.categories.index') }}"
           class="px-5 py-2.5 text-sm text-gray-500 border border-gray-200 
                  rounded-lg bg-white hover:bg-gray-50 transition-colors">
          Batal
        </a>
      </div>
    </div>
  </form>
</div>