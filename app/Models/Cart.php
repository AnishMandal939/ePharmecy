<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'product_id',
        'product_color_id',
        'quantity'
    ];
        // create relation to get product detail in wishlist
        public function product(): BelongsTo
        {
           return $this->belongsTo(Product::class, 'product_id', 'id');
        }
}
