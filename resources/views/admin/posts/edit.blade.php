<!-- resources/views/admin/posts/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')
@section('page-subtitle', $post->title)

@section('content')
  @include('admin.posts._form', [
    'post'   => $post,
    'action' => route('admin.posts.update', $post),
    'method' => 'PUT',
  ])
@endsection