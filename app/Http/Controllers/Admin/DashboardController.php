<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_posts'       => Post::count(),
            'published_posts'   => Post::where('status', 'published')->count(),
            'draft_posts'       => Post::where('status', 'draft')->count(),
            'total_categories'  => Category::count(),
        ];

        // 5 berita terbaru untuk ditampilkan di dashboard
        $recentPosts = Post::with(['category', 'author'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Jumlah berita per kategori (untuk chart/statistik)
        $categoryStats = Category::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentPosts',
            'categoryStats'
        ));
    }
}