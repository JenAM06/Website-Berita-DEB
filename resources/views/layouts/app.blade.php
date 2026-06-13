<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'EcoBetapus') — Portal Informasi DEB Sawah Betapus</title>
  <meta name="description"
        content="@yield('description', 
        'Portal informasi dan berita Desa Energi Berdikari Sawah Betapus, Samarinda.')"/>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 font-sans antialiased">

  {{-- ── TOP BAR ── --}}
  <div class="bg-primary-700 text-white text-xs py-2 hidden md:block">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
      <span class="text-primary-100">
        Program Desa Energi Berdikari — Kawasan Sawah Betapus, Samarinda
      </span>
      <div class="flex items-center gap-4">
        <a href="{{ route('home') }}" 
           class="text-primary-100 hover:text-white transition-colors">
          Beranda
        </a>
        <span class="text-primary-500">|</span>
        <a href="{{ route('about') }}"
           class="text-primary-100 hover:text-white transition-colors">
          Tentang Program
        </a>
        <span class="text-primary-500">|</span>
        <a href="{{ route('login') }}"
           class="text-primary-100 hover:text-white transition-colors">
          Admin
        </a>
      </div>
    </div>
  </div>

  {{-- ── NAVBAR UTAMA ── --}}
  <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
      <div class="flex items-center justify-between h-16">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3">
          <div class="w-10 h-10 bg-primary-700 rounded flex items-center 
                      justify-center shrink-0">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" 
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945
                       M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 
                       2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
            </svg>
          </div>
          <div class="leading-tight">
            <p class="font-black text-primary-700 text-lg tracking-tight 
                      leading-none">
              EcoBetapus
            </p>
            <p class="text-xs text-gray-400 leading-none mt-0.5">
              DEB Sobat Bumi Unmul
            </p>
          </div>
        </a>

        {{-- Menu Desktop --}}
        <div class="hidden md:flex items-center gap-0">
          <a href="{{ route('home') }}"
             class="px-4 py-5 text-sm font-semibold border-b-2 transition-all
             {{ request()->routeIs('home') 
                ? 'border-primary-600 text-primary-700' 
                : 'border-transparent text-gray-600 hover:text-primary-700 
                   hover:border-primary-300' }}">
            BERANDA
          </a>
          <a href="{{ route('posts.index') }}"
             class="px-4 py-5 text-sm font-semibold border-b-2 transition-all
             {{ request()->routeIs('posts.*') 
                ? 'border-primary-600 text-primary-700' 
                : 'border-transparent text-gray-600 hover:text-primary-700 
                   hover:border-primary-300' }}">
            BERITA
          </a>

          {{-- Dropdown Kategori --}}
          <div class="relative group">
            <button class="px-4 py-5 text-sm font-semibold border-b-2 
                           border-transparent text-gray-600 hover:text-primary-700
                           hover:border-primary-300 transition-all
                           flex items-center gap-1">
              KATEGORI
              <svg class="w-3.5 h-3.5 mt-0.5" fill="none" stroke="currentColor" 
                   viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      stroke-width="2.5" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>
            <div class="absolute top-full left-0 w-52 bg-white shadow-xl 
                        border-t-2 border-primary-600
                        opacity-0 invisible group-hover:opacity-100 
                        group-hover:visible transition-all duration-150">
              @php
                $navCategories = \App\Models\Category::withCount([
                    'posts' => fn($q) => $q->where('status','published')
                ])->get();
              @endphp
              @foreach($navCategories as $cat)
              <a href="{{ route('category.show', $cat->slug) }}"
                 class="flex items-center justify-between px-5 py-3 text-sm
                        text-gray-700 hover:bg-primary-50 
                        hover:text-primary-700 border-b border-gray-50
                        transition-colors">
                <span class="font-medium">{{ $cat->name }}</span>
                <span class="text-xs text-gray-400">
                  {{ $cat->posts_count }}
                </span>
              </a>
              @endforeach
            </div>
          </div>

          <a href="{{ route('about') }}"
             class="px-4 py-5 text-sm font-semibold border-b-2 transition-all
             {{ request()->routeIs('about') 
                ? 'border-primary-600 text-primary-700' 
                : 'border-transparent text-gray-600 hover:text-primary-700 
                   hover:border-primary-300' }}">
            TENTANG
          </a>
        </div>

        {{-- Search + Mobile Button --}}
        <div class="flex items-center gap-3">
          <a href="{{ route('posts.index') }}"
             class="p-2 text-gray-500 hover:text-primary-700 
                    transition-colors hidden md:block">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" 
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" 
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </a>

          {{-- Mobile Hamburger --}}
          <button id="mobile-menu-btn"
                  class="md:hidden p-2 text-gray-600 hover:bg-gray-100 
                         rounded transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" 
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" 
                    stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
        </div>
      </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100">
      <div class="px-4 py-3 space-y-1">
        <a href="{{ route('home') }}"
           class="block px-3 py-2.5 text-sm font-semibold rounded
           {{ request()->routeIs('home') 
              ? 'bg-primary-50 text-primary-700' 
              : 'text-gray-700 hover:bg-gray-50' }}">
          BERANDA
        </a>
        <a href="{{ route('posts.index') }}"
           class="block px-3 py-2.5 text-sm font-semibold rounded
           {{ request()->routeIs('posts.*') 
              ? 'bg-primary-50 text-primary-700' 
              : 'text-gray-700 hover:bg-gray-50' }}">
          BERITA
        </a>
        <a href="{{ route('about') }}"
           class="block px-3 py-2.5 text-sm font-semibold rounded
           {{ request()->routeIs('about') 
              ? 'bg-primary-50 text-primary-700' 
              : 'text-gray-700 hover:bg-gray-50' }}">
          TENTANG
        </a>
        <div class="pt-2 border-t border-gray-100">
          <p class="px-3 py-1 text-xs font-bold text-gray-400 uppercase 
                    tracking-widest">
            Kategori
          </p>
          @foreach($navCategories ?? [] as $cat)
          <a href="{{ route('category.show', $cat->slug) }}"
             class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-50 
                    rounded transition-colors">
            {{ $cat->name }}
          </a>
          @endforeach
        </div>
      </div>
    </div>
  </nav>

  {{-- ── KONTEN ── --}}
  <main>@yield('content')</main>

  {{-- ── FOOTER ── --}}
  <footer class="bg-gray-900 text-gray-400 mt-16">

    {{-- Footer Atas --}}
    <div class="max-w-7xl mx-auto px-6 py-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

        {{-- Brand --}}
        <div class="md:col-span-2">
          <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-primary-600 rounded flex items-center 
                        justify-center">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" 
                   viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      stroke-width="2"
                      d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945
                         M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 
                         0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
              </svg>
            </div>
            <div>
              <p class="font-black text-white text-lg leading-none">EcoBetapus</p>
              <p class="text-xs text-gray-500 mt-0.5">DEB Sobat Bumi Unmul</p>
            </div>
          </div>
          <p class="text-sm leading-relaxed text-gray-400 max-w-sm">
            Portal informasi dan dokumentasi digital Program Desa Energi Berdikari 
            Kawasan Sawah Betapus, Kelurahan Lempake, Samarinda, Kalimantan Timur.
          </p>
          <p class="text-xs text-gray-600 mt-4">
            Didukung oleh Pertamina Foundation
          </p>
        </div>

        {{-- Kategori --}}
        <div>
          <h4 class="text-white font-bold text-sm uppercase tracking-widest mb-4">
            Kategori
          </h4>
          <ul class="space-y-2">
            @foreach($navCategories ?? [] as $cat)
            <li>
              <a href="{{ route('category.show', $cat->slug) }}"
                 class="text-sm text-gray-400 hover:text-primary-400 
                        transition-colors">
                {{ $cat->name }}
              </a>
            </li>
            @endforeach
          </ul>
        </div>

        {{-- Info --}}
        <div>
          <h4 class="text-white font-bold text-sm uppercase tracking-widest mb-4">
            Lokasi Program
          </h4>
          <ul class="space-y-2 text-sm text-gray-400">
            <li>Kawasan Sawah Betapus</li>
            <li>Kelurahan Lempake</li>
            <li>Samarinda Utara</li>
            <li>Kalimantan Timur</li>
            <li class="pt-2 text-gray-500">
              Universitas Mulawarman
            </li>
          </ul>
        </div>
      </div>
    </div>

    {{-- Footer Bawah --}}
    <div class="border-t border-gray-800">
      <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row 
                  items-center justify-between gap-2">
        <p class="text-xs text-gray-600">
          &copy; {{ date('Y') }} EcoBetapus. Program DEB Sobat Bumi 
          Universitas Mulawarman.
        </p>
        <a href="{{ route('login') }}"
           class="text-xs text-gray-700 hover:text-gray-500 transition-colors">
          Admin Panel
        </a>
      </div>
    </div>
  </footer>

  <script>
    document.getElementById('mobile-menu-btn')
      ?.addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.toggle('hidden');
      });
  </script>
  @stack('scripts')
</body>
</html>