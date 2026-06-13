<?php
// app/Http/Controllers/PublicController.php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    // ── Beranda ──────────────────────────────────
    public function home()
    {
        // 6 berita terbaru untuk hero section
        $latestPosts = Post::with(['category', 'author'])
            ->published()
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        // 1 berita utama (featured)
        $featuredPost = $latestPosts->first();

        // 5 berita lainnya untuk grid
        $recentPosts = $latestPosts->skip(1)->take(5);

        // Semua kategori untuk navbar/sidebar
        $categories = Category::withCount([
            'posts' => fn($q) => $q->published()
        ])->get();

        return view('public.home', compact(
            'featuredPost',
            'recentPosts',
            'categories'
        ));
    }

    // ── Daftar Berita + Search ────────────────────
    public function index(Request $request)
    {
        $search = $request->input('search');

        $posts = Post::with(['category', 'author'])
            ->published()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
            })
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = Category::withCount([
            'posts' => fn($q) => $q->published()
        ])->get();

        return view('public.posts.index', compact(
            'posts',
            'categories',
            'search'
        ));
    }

    // ── Detail Berita ─────────────────────────────
    public function show($slug)
    {
        $post = Post::with(['category', 'author'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        // 3 berita terkait dari kategori yang sama
        $relatedPosts = Post::with(['category', 'author'])
            ->published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $categories = Category::withCount([
            'posts' => fn($q) => $q->published()
        ])->get();

        return view('public.posts.show', compact(
            'post',
            'relatedPosts',
            'categories'
        ));
    }

    // ── Berita per Kategori ───────────────────────
    public function category(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $search = $request->input('search');

        $posts = Post::with(['category', 'author'])
            ->published()
            ->where('category_id', $category->id)
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = Category::withCount([
            'posts' => fn($q) => $q->published()
        ])->get();

        return view('public.posts.category', compact(
            'category',
            'posts',
            'categories',
            'search'
        ));
    }

    // ── Halaman Tentang ───────────────────────────
    public function about()
    {
        $categories = Category::withCount([
            'posts' => fn($q) => $q->published()
        ])->get();

        $totalPosts = Post::published()->count();

        return view('public.about', compact('categories', 'totalPosts'));
    }
}