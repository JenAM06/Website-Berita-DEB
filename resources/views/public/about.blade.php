<!-- resources/views/public/about.blade.php -->
@extends('layouts.app')

@section('title', 'Tentang EcoBetapus')

@section('content')

<div class="bg-gradient-to-br from-primary-700 to-primary-600 text-white py-16">
  <div class="max-w-4xl mx-auto px-4 text-center">
    <div class="text-6xl mb-4">🌿</div>
    <h1 class="text-4xl font-bold mb-4">Tentang EcoBetapus</h1>
    <p class="text-primary-200 text-lg leading-relaxed">
      Portal informasi digital Desa Energi Berdikari Sawah Betapus
    </p>
  </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14">

  {{-- Deskripsi --}}
  <div class="card p-8 mb-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Apa itu EcoBetapus?</h2>
    <p class="text-gray-600 leading-relaxed mb-4">
      EcoBetapus adalah portal informasi dan berita digital yang menyajikan 
      berbagai informasi terkait kegiatan, program, dan perkembangan 
      <strong>Desa Energi Berdikari (DEB) Kawasan Sawah Betapus</strong>, 
      Kelurahan Lempake, Kecamatan Samarinda Utara, Kota Samarinda, 
      Kalimantan Timur.
    </p>
    <p class="text-gray-600 leading-relaxed">
      Program DEB merupakan inisiatif dari Tim Sobat Bumi Universitas Mulawarman 
      yang didukung oleh Pertamina Foundation. Program ini berfokus pada 
      pengembangan energi terbarukan, pengelolaan lingkungan, pemberdayaan 
      ekonomi masyarakat, edukasi, dan penguatan kawasan wisata berbasis 
      keberlanjutan.
    </p>
  </div>

  {{-- 4 Pilar --}}
  <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
    4 Pilar Program DEB
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-10">
    @foreach([
      ['⚡','Pilar Energi','Pengembangan PLTS Off-Grid 3.480 WP yang menyuplai listrik bagi 5 UMKM kuliner dan mendukung pertanian melalui mesin Spin Dry Pad.','from-yellow-50 to-yellow-100','text-yellow-700'],
      ['🌿','Pilar Lingkungan','Penguatan Bank Sampah dan budidaya maggot Black Soldier Fly untuk pengelolaan sampah organik 37,2 kg/hari menjadi produk bernilai ekonomi.','from-green-50 to-green-100','text-green-700'],
      ['📚','Pilar Edukasi','Program Goes to School menjangkau 408 siswa SMAN 9 Samarinda untuk edukasi pemilahan sampah dan pengenalan bank sampah.','from-blue-50 to-blue-100','text-blue-700'],
      ['💰','Pilar Ekonomi','Budidaya maggot menghasilkan produk berupa maggot segar, maggot kering, dan kasgot yang dipasarkan kepada peternak lokal.','from-purple-50 to-purple-100','text-purple-700'],
    ] as [$icon, $title, $desc, $bg, $color])
    <div class="card p-6 bg-gradient-to-br {{ $bg }} border-0">
      <div class="text-4xl mb-3">{{ $icon }}</div>
      <h3 class="font-bold {{ $color }} mb-2 text-lg">{{ $title }}</h3>
      <p class="text-gray-600 text-sm leading-relaxed">{{ $desc }}</p>
    </div>
    @endforeach
  </div>

  {{-- Statistik --}}
  <div class="card p-8 bg-gradient-to-br from-primary-600 to-primary-800 
              text-white border-0">
    <h2 class="text-xl font-bold mb-6 text-center">Dampak Program</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
      @foreach([
        ['± 500','Penerima Manfaat Langsung'],
        ['5.250 kg','Reduksi CO₂/Tahun'],
        ['37,2 kg','Sampah Dikelola/Hari'],
        [$totalPosts . '+','Artikel Diterbitkan'],
      ] as [$val, $label])
      <div>
        <div class="text-2xl font-bold">{{ $val }}</div>
        <div class="text-primary-200 text-xs mt-1">{{ $label }}</div>
      </div>
      @endforeach
    </div>
  </div>

</div>

@endsection