<?php
// app/Models/Post.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Relasi ke User (penulis)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scope: hanya tampilkan yang published
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Accessor: normalkan nilai kolom image
    // — jika sudah base64 data URI → pakai langsung
    // — jika masih path lama (posts/xxx.jpg) → coba pakai storage URL
    // — jika null → return null
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }
        // Sudah base64 data URI
        if (str_starts_with($this->image, 'data:')) {
            return $this->image;
        }
        // Path lama — kembalikan storage URL (mungkin masih bekerja di sesi yang sama)
        return asset('storage/' . $this->image);
    }
}