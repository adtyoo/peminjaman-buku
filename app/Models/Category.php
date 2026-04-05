<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    // Relasi ke Buku
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    // 🔥 Relasi ke Subkategori
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}