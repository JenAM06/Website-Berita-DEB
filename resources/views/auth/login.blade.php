<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Admin — EcoBetapus</title>
  @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-gradient-to-br from-primary-800 via-primary-700 
             to-primary-600 flex items-center justify-center p-4 font-sans">

  <div class="w-full max-w-md">

    {{-- Logo --}}
    <div class="text-center mb-8">
      <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center 
                  mx-auto mb-4 shadow-lg">
        <span class="text-primary-600 font-black text-3xl">E</span>
      </div>
      <h1 class="text-white font-bold text-2xl">EcoBetapus</h1>
      <p class="text-primary-200 text-sm mt-1">Admin Panel</p>
    </div>

    {{-- Card Login --}}
    <div class="bg-white rounded-3xl shadow-2xl p-8">
      <h2 class="text-xl font-bold text-gray-800 mb-1">Selamat Datang</h2>
      <p class="text-gray-400 text-sm mb-6">
        Masuk untuk mengelola konten EcoBetapus
      </p>

      {{-- Session Error --}}
      @if(session('status'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-xl 
                    text-sm text-green-700">
          {{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-4">
          <label class="block text-sm font-semibold text-gray-700 mb-2">
            Email
          </label>
          <input type="email" name="email"
                 value="{{ old('email') }}"
                 placeholder="admin@ecobetapus.id"
                 autofocus autocomplete="username"
                 class="w-full px-4 py-3 border rounded-xl text-sm 
                        focus:outline-none focus:ring-2 focus:ring-primary-500
                        @error('email') border-red-400 bg-red-50 
                        @else border-gray-200 @enderror"/>
          @error('email')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Password --}}
        <div class="mb-5">
          <label class="block text-sm font-semibold text-gray-700 mb-2">
            Password
          </label>
          <input type="password" name="password"
                 placeholder="••••••••"
                 autocomplete="current-password"
                 class="w-full px-4 py-3 border border-gray-200 rounded-xl 
                        text-sm focus:outline-none focus:ring-2 
                        focus:ring-primary-500"/>
          @error('password')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Remember --}}
        <div class="flex items-center justify-between mb-6">
          <label class="flex items-center gap-2 text-sm text-gray-600 
                        cursor-pointer">
            <input type="checkbox" name="remember"
                   class="rounded border-gray-300 text-primary-600 
                          focus:ring-primary-500"/>
            Ingat saya
          </label>
        </div>

        <button type="submit" class="btn-primary w-full justify-center text-base">
          Masuk ke Dashboard
        </button>
      </form>

      <div class="mt-6 pt-5 border-t border-gray-100 text-center">
        <a href="{{ route('home') }}"
           class="text-sm text-gray-400 hover:text-primary-600 transition-colors">
          ← Kembali ke Website
        </a>
      </div>
    </div>

    <p class="text-center text-primary-200 text-xs mt-6">
      © {{ date('Y') }} EcoBetapus — DEB Sobat Bumi Universitas Mulawarman
    </p>
  </div>

</body>
</html>