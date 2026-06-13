<!-- resources/views/admin/categories/edit.blade.php -->
@extends('layouts.admin')
@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
  @include('admin.categories._form', [
    'category' => $category,
    'action'   => route('admin.categories.update', $category),
    'method'   => 'PUT',
  ])
@endsection