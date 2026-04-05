<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'year',
        'pages',
        'isbn',
        'category_id',
        'subcategory_id',
        'description',
        'image',
        'stock_total',
        'stock_available'
    ];

    /**
     * RELASI KE CATEGORY
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * RELASI KE SUBCATEGORY
     */
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    /**
     * RELASI KE DETAIL PEMINJAMAN
     */
    public function borrowingDetails()
    {
        return $this->hasMany(BorrowingDetail::class);
    }

    /**
     * 🔥 ACCESSOR URL GAMBAR
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return asset('images/no-image.png');
    }

    /**
     * 🔥 STATUS STOK (BIAR MUDAH DI VIEW)
     */
    public function getStockStatusAttribute()
    {
        return $this->stock_available > 0 ? 'Tersedia' : 'Habis';
    }

    /**
     * 🔥 CEK BISA DIPINJAM ATAU TIDAK
     */
    public function isAvailable()
    {
        return $this->stock_available > 0;
    }
}