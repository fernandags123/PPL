<?php

namespace App\Models;

use App\Models\KomentarRating;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function komentarRatings()
{
    return $this->hasMany(KomentarRating::class, 'product_id');
}

    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_produk',
        'deskripsi',
        'kategori',
        'harga',
        'discount_percent',  
        'stock',
        'is_official',
        'is_new',
        'gambar',
        'rating',
        'rating_count',
        'sold_count',
    ];

    protected $casts = [
        'harga'            => 'integer',
        'discount_percent' => 'integer',
        'stock'            => 'integer',
        'is_official'      => 'boolean',
        'is_new'           => 'boolean',
    ];
}
