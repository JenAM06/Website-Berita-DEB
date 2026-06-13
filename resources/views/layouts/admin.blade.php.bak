<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Admin') — EcoBetapus</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex h-screen overflow-hidden">

  {{-- ── SIDEBAR ── --}}
  <aside id="sidebar"
         class="w-64 bg-gray-900 text-white flex flex-col
                fixed inset-y-0 left-0 z-50
                transform -translate-x-full md:translate-x-0
                transition-transform duration-300">

    {{-- Logo --}}
    <div class="h-16 flex items-center gap-3 px-5
                border-b border-gray-800 shrink-0">
      <div class="w-8 h-8 bg-primary-600 rounded flex items-center
                  justify-center text-white font-bold text-sm">E</div>
      <div>
        <p class="font-bold text-white text-sm leading-none">EcoBetapus</p>
        <p class="text-xs text-gray-500 leading-none mt-0.5">Panel Admin</p>
      </div>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 py-4 overflow-y-auto">

      <p class="px-5 mb-1 text-xs font-semibold text-gray-600 
                uppercase tracking-wider">
        Menu
      </p>

      <a href="{{ route('admin.dashboard') }}"
         class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors
         {{ request()->routeIs('admin.dashboard')
            ? 'bg-primary-600 text-white'
            : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10
                   a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1
                   v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        Dashboard
      </a>

      <p class="px-5 mt-5 mb-1 text-xs font-semibold text-gray-600 
                uppercase tracking-wider">
        Konten
      </p>

      <a href="{{ route('admin.posts.index') }}"
         class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors
         {{ request()->routeIs('admin.posts.*')
            ? 'bg-primary-600 text-white'
            : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586
                   a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        Manajemen Berita
        @php $totalPosts = \App\Models\Post::count(); @endphp
        <span class="ml-auto bg-gray-800 text-gray-400 text-xs
                     px-2 py-0.5 rounded-full">
          {{ $totalPosts }}
        </span>
      </a>

      <a href="{{ route('admin.categories.index') }}"
         class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors
         {{ request()->routeIs('admin.categories.*')
            ? 'bg-primary-600 text-white'
            : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828
                   l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
        </svg>
        Manajemen Kategori
      </a>

      <p class="px-5 mt-5 mb-1 text-xs font-semibold text-gray-600 
                uppercase tracking-wider">
        Lainnya
      </p>

      <a href="{{ route('home') }}" target="_blank"
         class="flex items-center gap-3 px-5 py-2.5 text-sm
                text-gray-400 hover:bg-gray-800 hover:text-white transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0
                   0v6m0-6L10 14"/>
        </svg>
        Lihat Website
      </a>
    </nav>

    {{-- User + Logout --}}
    <div class="border-t border-gray-800 p-4 shrink-0">
      <div class="flex items-center gap-3 mb-3">
        <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center
                    justify-center text-white font-bold text-xs shrink-0">
          {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div class="overflow-hidden">
          <p class="text-sm font-medium text-white truncate">
            {{ auth()->user()->name }}
          </p>
          <p class="text-xs text-gray-500 truncate">
            {{ auth()->user()->email }}
          </p>
        </div>
      </div>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
                class="w-full flex items-center gap-2 px-3 py-2 text-sm
                       text-gray-500 hover:text-white hover:bg-gray-800
                       rounded transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3
                     V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
          Keluar
        </button>
      </form>
    </div>
  </aside>

  {{-- Overlay Mobile --}}
  <div id="sidebar-overlay"
       class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"
       onclick="toggleSidebar()"></div>

  {{-- ── MAIN ── --}}
  <div class="flex-1 flex flex-col md:ml-64 overflow-hidden">

    {{-- Topbar --}}
    <header class="h-16 bg-white border-b border-gray-200 flex items-center
                   justify-between px-4 sm:px-6 shrink-0">
      <div class="flex items-center gap-3">
        <button onclick="toggleSidebar()"
                class="md:hidden p-2 rounded text-gray-500
                       hover:bg-gray-100 transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
        <div>
          <h1 class="text-base font-bold text-gray-800">
            @yield('page-title', 'Dashboard')
          </h1>
          <p class="text-xs text-gray-400 hidden sm:block">
            @yield('page-subtitle', 'Panel Admin EcoBetapus')
          </p>
        </div>
      </div>
      <div class="flex items-center gap-3">
        <span class="text-xs text-gray-400 hidden sm:block">
          {{ now()->translatedFormat('d F Y') }}
        </span>
        <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center
                    justify-center text-white font-bold text-xs">
          {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
      </div>
    </header>

    {{-- Konten --}}
    <main class="flex-1 overflow-y-auto p-4 sm:p-6">

      {{-- Flash Success --}}
      @if(session('success'))
      <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg
                  flex items-center gap-3 text-green-800">
        <svg class="w-5 h-5 text-green-500 shrink-0" fill="none"
             stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span class="text-sm font-medium">{{ session('success') }}</span>
      </div>
      @endif

      {{-- Flash Error --}}
      @if(session('error'))
      <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg
                  flex items-center gap-3 text-red-800">
        <svg class="w-5 h-5 text-red-500 shrink-0" fill="none"
             stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span class="text-sm font-medium">{{ session('error') }}</span>
      </div>
      @endif

      @yield('content')
    </main>
  </div>
</div>

<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('-translate-x-full');
    document.getElementById('sidebar-overlay').classList.toggle('hidden');
  }
</script>
@stack('scripts')
</body>
</html>