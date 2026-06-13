<?php
// app/Http/Controllers/Admin/PostController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostController extends Controller
{
    // ── Index + Search ────────────────────────────
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $posts = Post::with(['category', 'author'])
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhereHas('category', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.posts.index', compact('posts', 'search', 'status'));
    }

    // ── Form Tambah Berita ────────────────────────
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.create', compact('categories'));
    }

    // ── Simpan Berita Baru ────────────────────────
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt'     => 'nullable|string|max:500',
            'content'     => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'      => 'required|in:draft,published',
            'published_at'=> 'nullable|date',
        ]);

        // Handle upload gambar — simpan sebagai base64 di DB (Railway-safe)
        $imageData = null;
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $mime     = $file->getMimeType();
            $base64   = base64_encode(file_get_contents($file->getRealPath()));
            $imageData = "data:{$mime};base64,{$base64}";
        }

        // Generate slug unik
        $slug = $this->generateUniqueSlug($request->title);

        Post::create([
            'user_id'      => auth()->id(),
            'category_id'  => $validated['category_id'],
            'title'        => $validated['title'],
            'slug'         => $slug,
            'excerpt'      => $validated['excerpt'],
            'content'      => $validated['content'],
            'image'        => $imageData,
            'status'       => $validated['status'],
            'published_at' => $validated['published_at']
                ?? ($validated['status'] === 'published' ? Carbon::now() : null),
        ]);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    // ── Detail Berita (Admin) ─────────────────────
    public function show(Post $post)
    {
        $post->load(['category', 'author']);
        return view('admin.posts.show', compact('post'));
    }

    // ── Form Edit Berita ──────────────────────────
    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    // ── Update Berita ─────────────────────────────
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt'     => 'nullable|string|max:500',
            'content'     => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'      => 'required|in:draft,published',
            'published_at'=> 'nullable|date',
        ]);

        // Handle upload gambar baru — simpan sebagai base64 di DB (Railway-safe)
        $imageData = $post->image; // tetap pakai gambar lama jika tidak ada upload baru
        if ($request->hasFile('image')) {
            $file      = $request->file('image');
            $mime      = $file->getMimeType();
            $base64    = base64_encode(file_get_contents($file->getRealPath()));
            $imageData = "data:{$mime};base64,{$base64}";
        }

        // Update slug hanya jika judul berubah
        $slug = $post->slug;
        if ($post->title !== $request->title) {
            $slug = $this->generateUniqueSlug($request->title, $post->id);
        }

        $post->update([
            'category_id'  => $validated['category_id'],
            'title'        => $validated['title'],
            'slug'         => $slug,
            'excerpt'      => $validated['excerpt'],
            'content'      => $validated['content'],
            'image'        => $imageData,
            'status'       => $validated['status'],
            'published_at' => $validated['published_at']
                ?? ($validated['status'] === 'published' && !$post->published_at
                    ? Carbon::now()
                    : $post->published_at),
        ]);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    // ── Hapus Berita ──────────────────────────────
    public function destroy(Post $post)
    {
        // Gambar tersimpan sebagai base64 di DB, cukup hapus record-nya
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    // ── Helper: Generate Slug Unik ────────────────
    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (true) {
            $query = Post::where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
            if (!$query->exists()) break;
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }
}