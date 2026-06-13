<!-- resources/views/admin/posts/create.blade.php -->
@extends('layouts.admin')

@section('title', 'Tambah Berita')
@section('page-title', 'Tambah Berita Baru')
@section('page-subtitle', 'Buat dan publikasikan berita baru')

@section('content')
  @include('admin.posts._form', [
    'post'   => null,
    'action' => route('admin.posts.store'),
    'method' => 'POST',
  ])
@endsection