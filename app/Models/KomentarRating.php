<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarRating extends Model
{
    use HasFactory;

    protected $table = 'komentar_rating';

    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'komentar',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
