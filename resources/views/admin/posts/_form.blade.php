<!-- resources/views/admin/posts/_form.blade.php -->
<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @csrf
  @if($method !== 'POST')
    @method($method)
  @endif

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ── KOLOM KIRI ── --}}
    <div class="lg:col-span-2 space-y-5">

      {{-- Judul --}}
      <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <label class="block text-sm font-semibold text-gray-700 mb-2">
          Judul Berita <span class="text-red-500">*</span>
        </label>
        <input type="text" name="title"
               value="{{ old('title', $post?->title) }}"
               placeholder="Masukkan judul berita..."
               class="w-full px-4 py-3 border rounded-xl text-sm
                      focus:outline-none focus:ring-2 focus:ring-primary-500
                      @error('title') border-red-400 bg-red-50 
                      @else border-gray-200 @enderror"/>
        @error('title')
          <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Ringkasan --}}
      <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <label class="block text-sm font-semibold text-gray-700 mb-2">
          Ringkasan
          <span class="font-normal text-gray-400 ml-1">(opsional, maks. 500 karakter)</span>
        </label>
        <textarea name="excerpt" rows="3"
                  placeholder="Ringkasan singkat berita..."
                  class="w-full px-4 py-3 border border-gray-200 rounded-xl
                         text-sm focus:outline-none focus:ring-2
                         focus:ring-primary-500 resize-none
                         @error('excerpt') border-red-400 bg-red-50 @enderror">{{ old('excerpt', $post?->excerpt) }}</textarea>
        @error('excerpt')
          <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Isi Berita --}}
      <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <label class="block text-sm font-semibold text-gray-700 mb-2">
          Isi Berita <span class="text-red-500">*</span>
        </label>
        {{-- Hidden textarea to hold the HTML value for form submission --}}
        <textarea name="content" id="content" class="hidden @error('content') border-red-400 bg-red-50 @enderror">{{ old('content', $post?->content) }}</textarea>
        {{-- Quill editor container --}}
        <div id="quill-editor"
             class="min-h-[300px] rounded-xl text-sm @error('content') border-2 border-red-400 @else border border-gray-200 @enderror">
        </div>
        @error('content')
          <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
      </div>

    </div>

    {{-- ── KOLOM KANAN ── --}}
    <div class="space-y-5">

      {{-- Tombol Aksi --}}
      <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
        <h3 class="font-semibold text-gray-700 mb-4 text-sm">Publikasi</h3>
        <div class="space-y-3">
          <button type="submit"
                  class="w-full bg-primary-600 hover:bg-primary-700 text-white
                         font-semibold py-2.5 px-4 rounded-lg text-sm
                         transition-colors text-center">
            {{ $post ? 'Simpan Perubahan' : 'Publikasikan Berita' }}
          </button>
          <a href="{{ route('admin.posts.index') }}"
             class="block text-center px-4 py-2.5 text-sm text-gray-500
                    border border-gray-200 rounded-lg hover:bg-gray-50
                    transition-colors">
            Batal
          </a>
        </div>
      </div>

      {{-- Status --}}
      <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
        <label class="block text-sm font-semibold text-gray-700 mb-2">
          Status <span class="text-red-500">*</span>
        </label>
        <select name="status"
                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl
                       text-sm focus:outline-none focus:ring-2
                       focus:ring-primary-500 bg-white text-gray-700">
          <option value="published"
                  {{ old('status', $post?->status ?? 'published') === 'published'
                     ? 'selected' : '' }}>
            Publik
          </option>
          <option value="draft"
                  {{ old('status', $post?->status) === 'draft' ? 'selected' : '' }}>
            Draft
          </option>
        </select>
      </div>

      {{-- Kategori --}}
      <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
        <label class="block text-sm font-semibold text-gray-700 mb-2">
          Kategori <span class="text-red-500">*</span>
        </label>
        <select name="category_id"
                class="w-full px-4 py-2.5 border rounded-xl text-sm
                       focus:outline-none focus:ring-2 focus:ring-primary-500
                       bg-white text-gray-700
                       @error('category_id') border-red-400 
                       @else border-gray-200 @enderror">
          <option value="">Pilih Kategori</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}"
                    {{ old('category_id', $post?->category_id) == $cat->id
                       ? 'selected' : '' }}>
              {{ $cat->name }}
            </option>
          @endforeach
        </select>
        @error('category_id')
          <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Tanggal Publikasi --}}
      <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
        <label class="block text-sm font-semibold text-gray-700 mb-2">
          Tanggal Publikasi
        </label>
        <input type="datetime-local" name="published_at"
               value="{{ old('published_at', $post?->published_at?->format('Y-m-d\TH:i')) }}"
               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl
                      text-sm focus:outline-none focus:ring-2
                      focus:ring-primary-500 text-gray-700"/>
        <p class="text-xs text-gray-400 mt-1.5">
          Kosongkan untuk menggunakan waktu sekarang.
        </p>
      </div>

      {{-- Gambar --}}
      <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
        <label class="block text-sm font-semibold text-gray-700 mb-2">
          Gambar Berita
        </label>

        @if($post?->image)
        <div class="mb-3" id="current-image-wrapper">
          {{-- Gambar tersimpan sebagai base64 data URI di DB, langsung pakai sebagai src --}}
          <img src="{{ $post->image_url }}"
               alt="Gambar saat ini"
               class="w-full h-40 object-cover rounded-lg border border-gray-200"/>
          <p class="text-xs text-gray-400 mt-1">Gambar saat ini</p>
        </div>
        @endif

        <div id="image-preview" class="mb-3 hidden">
          <img id="preview-img" src="" alt="Preview"
               class="w-full h-40 object-cover rounded-lg border border-gray-200"/>
          <p class="text-xs text-gray-400 mt-1">Preview gambar baru</p>
        </div>

        <label class="block w-full cursor-pointer">
          <div class="border-2 border-dashed border-gray-200 rounded-xl p-5
                      text-center hover:border-primary-400 hover:bg-primary-50
                      transition-colors">
            <svg class="w-8 h-8 mx-auto text-gray-300 mb-2" fill="none"
                 stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586
                       a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2
                       0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-sm text-gray-500 font-medium">Klik untuk upload gambar</p>
            <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP — Maks. 2MB</p>
          </div>
          <input type="file" name="image" id="image-input"
                 accept="image/jpeg,image/png,image/jpg,image/webp"
                 class="hidden"/>
        </label>

        @error('image')
          <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
      </div>

    </div>
  </div>
</form>

@push('scripts')
{{-- Quill rich text editor --}}
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
  // Initialize Quill
  var quill = new Quill('#quill-editor', {
    theme: 'snow',
    placeholder: 'Tulis isi berita di sini...',
    modules: {
      toolbar: [
        [{ 'header': [1, 2, 3, false] }],
        ['bold', 'italic', 'underline'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        ['link'],
        ['clean']
      ]
    }
  });

  // Load existing content into Quill
  var existingContent = document.getElementById('content').value;
  if (existingContent) {
    quill.root.innerHTML = existingContent;
  }

  // Before form submit, copy Quill HTML to the hidden textarea
  var form = document.querySelector('form');
  form.addEventListener('submit', function() {
    document.getElementById('content').value = quill.root.innerHTML;
  });

  // Image preview
  document.getElementById('image-input')
    .addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = function(event) {
        document.getElementById('preview-img').src = event.target.result;
        document.getElementById('image-preview').classList.remove('hidden');
      };
      reader.readAsDataURL(file);
    });
</script>
@endpush