<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'EcoBetapus') — Portal Informasi DEB Sawah Betapus</title>
  <meta name="description" 
        content="@yield('description', 'Portal informasi dan berita Desa Energi Berdikari Sawah Betapus, Samarinda.')"/>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

  {{-- ── NAVBAR ── --}}
  <nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2">
          <div class="w-9 h-9 bg-primary-600 rounded-lg flex items-center 
                      justify-center text-white font-bold text-lg">E</div>
          <div>
            <span class="font-bold text-primary-700 text-lg leading-none">
              Eco
            </span><span class="font-bold text-gray-800 text-lg leading-none">
              Betapus
            </span>
            <p class="text-xs text-gray-400 leading-none">
              DEB Sawah Betapus
            </p>
          </div>
        </a>

        {{-- Menu Desktop --}}
        <div class="hidden md:flex items-center gap-6">
          <a href="{{ route('home') }}"
             class="text-sm font-medium transition-colors
             {{ request()->routeIs('home') 
                ? 'text-primary-600' : 'text-gray-600 hover:text-primary-600' }}">
            Beranda
          </a>
          <a href="{{ route('posts.index') }}"
             class="text-sm font-medium transition-colors
             {{ request()->routeIs('posts.*') 
                ? 'text-primary-600' : 'text-gray-600 hover:text-primary-600' }}">
            Berita
          </a>

          {{-- Dropdown Kategori --}}
          <div class="relative group">
            <button class="text-sm font-medium text-gray-600 
                           hover:text-primary-600 transition-colors
                           flex items-center gap-1">
              Kategori
              <svg class="w-4 h-4" fill="none" stroke="currentColor" 
                   viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>
            <div class="absolute top-full left-0 mt-1 w-48 bg-white rounded-xl 
                        shadow-lg border border-gray-100 opacity-0 invisible 
                        group-hover:opacity-100 group-hover:visible 
                        transition-all duration-200 py-1">
              @php
                $navCategories = \App\Models\Category::withCount([
                    'posts' => fn($q) => $q->where('status','published')
                ])->get();
              @endphp
              @foreach($navCategories as $cat)
              <a href="{{ route('category.show', $cat->slug) }}"
                 class="flex items-center justify-between px-4 py-2 text-sm 
                        text-gray-700 hover:bg-primary-50 
                        hover:text-primary-700 transition-colors">
                {{ $cat->name }}
                <span class="text-xs bg-gray-100 text-gray-500 
                             px-2 py-0.5 rounded-full">
                  {{ $cat->posts_count }}
                </span>
              </a>
              @endforeach
            </div>
          </div>

          <a href="{{ route('about') }}"
             class="text-sm font-medium transition-colors
             {{ request()->routeIs('about') 
                ? 'text-primary-600' : 'text-gray-600 hover:text-primary-600' }}">
            Tentang
          </a>

          <a href="{{ route('login') }}"
            class="text-sm font-medium bg-primary-600 text-white 
                    px-4 py-2 rounded-lg hover:bg-primary-700 
                    transition-colors">
            Login Admin
            </a>
        </div>

        {{-- Search Bar Desktop --}}
        <form action="{{ route('posts.index') }}" method="GET"
              class="hidden md:flex items-center">
          <div class="relative">
            <input type="text" name="search"
                   placeholder="Cari berita..."
                   value="{{ request('search') }}"
                   class="w-56 pl-9 pr-4 py-2 text-sm border border-gray-200 
                          rounded-lg focus:outline-none focus:ring-2 
                          focus:ring-primary-500 focus:border-transparent
                          bg-gray-50"/>
            <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" 
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </div>
        </form>

        {{-- Mobile Menu Button --}}
        <button id="mobile-menu-btn"
                class="md:hidden p-2 rounded-lg text-gray-600 
                       hover:bg-gray-100 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" 
               viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" 
                  stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100">
      <div class="px-4 py-3 space-y-2">
        <form action="{{ route('posts.index') }}" method="GET" class="mb-3">
          <div class="relative">
            <input type="text" name="search"
                   placeholder="Cari berita..."
                   value="{{ request('search') }}"
                   class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 
                          rounded-lg focus:outline-none focus:ring-2 
                          focus:ring-primary-500 bg-gray-50"/>
            <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" 
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </div>
        </form>
        <a href="{{ route('home') }}"
           class="block px-3 py-2 rounded-lg text-sm font-medium
           {{ request()->routeIs('home') 
              ? 'bg-primary-50 text-primary-700' 
              : 'text-gray-700 hover:bg-gray-100' }}">
          Beranda
        </a>
        <a href="{{ route('posts.index') }}"
           class="block px-3 py-2 rounded-lg text-sm font-medium
           {{ request()->routeIs('posts.*') 
              ? 'bg-primary-50 text-primary-700' 
              : 'text-gray-700 hover:bg-gray-100' }}">
          Berita
        </a>
        <a href="{{ route('about') }}"
           class="block px-3 py-2 rounded-lg text-sm font-medium
           {{ request()->routeIs('about') 
              ? 'bg-primary-50 text-primary-700' 
              : 'text-gray-700 hover:bg-gray-100' }}">
          Tentang
        </a>
        <div class="pt-1 border-t border-gray-100">
          <p class="px-3 py-1 text-xs font-semibold text-gray-400 uppercase">
            Kategori
          </p>
          @foreach($navCategories ?? [] as $cat)
          <a href="{{ route('category.show', $cat->slug) }}"
             class="block px-3 py-2 rounded-lg text-sm text-gray-700 
                    hover:bg-gray-100">
            {{ $cat->name }}
          </a>
          @endforeach
        </div>
      </div>
    </div>
  </nav>

  {{-- ── KONTEN UTAMA ── --}}
  <main>
    @yield('content')
  </main>

  {{-- ── FOOTER ── --}}
  <footer class="bg-gray-900 text-gray-300 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        {{-- Kolom 1: Brand --}}
        <div>
          <div class="flex items-center gap-2 mb-4">
            <div class="w-9 h-9 bg-primary-600 rounded-lg flex items-center 
                        justify-center text-white font-bold text-lg">E</div>
            <span class="font-bold text-white text-xl">EcoBetapus</span>
          </div>
          <p class="text-sm leading-relaxed text-gray-400">
            Portal informasi dan dokumentasi digital Desa Energi Berdikari (DEB) 
            Kawasan Sawah Betapus, Kelurahan Lempake, Samarinda, Kalimantan Timur.
          </p>
        </div>

        {{-- Kolom 2: Kategori --}}
        <div>
          <h3 class="font-semibold text-white mb-4">Kategori</h3>
          <ul class="space-y-2">
            @foreach($navCategories ?? [] as $cat)
            <li>
              <a href="{{ route('category.show', $cat->slug) }}"
                 class="text-sm text-gray-400 hover:text-primary-400 
                        transition-colors">
                → {{ $cat->name }}
              </a>
            </li>
            @endforeach
          </ul>
        </div>

        {{-- Kolom 3: Info --}}
        <div>
          <h3 class="font-semibold text-white mb-4">Tentang Program</h3>
          <ul class="space-y-2 text-sm text-gray-400">
            <li>📍 Kawasan Sawah Betapus, Lempake</li>
            <li>🏫 Universitas Mulawarman</li>
            <li>🌿 Program DEB Sobat Bumi</li>
            <li>⛽ Didukung Pertamina Foundation</li>
          </ul>
        </div>
      </div>

      <div class="mt-8 pt-8 border-t border-gray-800 text-center text-sm 
                  text-gray-500">
        © {{ date('Y') }} EcoBetapus — DEB Sobat Bumi Universitas Mulawarman. 
        Semua hak dilindungi.
      </div>
    </div>
  </footer>

  {{-- Mobile Menu Script --}}
  <script>
    document.getElementById('mobile-menu-btn')
      .addEventListener('click', function () {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
      });
  </script>

  @stack('scripts')
</body>
</html>