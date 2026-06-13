<!-- resources/views/admin/categories/create.blade.php -->
@extends('layouts.admin')
@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('content')
  @include('admin.categories._form', [
    'category' => null,
    'action'   => route('admin.categories.store'),
    'method'   => 'POST',
  ])
@endsection