<?php
// app/Http/Controllers/Admin/CategoryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // ── Daftar Kategori ───────────────────────────
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::withCount('posts')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10);

        return view('admin.categories.index', compact('categories', 'search'));
    }

    // ── Form Tambah Kategori ──────────────────────
    public function create()
    {
        return view('admin.categories.create');
    }

    // ── Simpan Kategori Baru ──────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string|max:255',
        ]);

        Category::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    // ── Form Edit Kategori ────────────────────────
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // ── Update Kategori ───────────────────────────
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'        => 'required|string|max:100|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:255',
        ]);

        $category->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    // ── Hapus Kategori ────────────────────────────
    public function destroy(Category $category)
    {
        // Cek apakah kategori masih digunakan
        if ($category->posts()->count() > 0) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki berita!');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }

    // show() tidak digunakan, tapi wajib ada karena --resource
    public function show(Category $category)
    {
        return redirect()->route('admin.categories.index');
    }
}