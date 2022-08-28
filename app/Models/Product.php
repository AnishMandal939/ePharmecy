<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\ProductColor;

class Product extends Model
{
    use HasFactory;
    // your code
    // assign that product table name 
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'brand',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'quantity',
        'trending',
        'status',
        'meta_title',
        'meta_keyword',
        'meta_description',
    ];

    // for to show product name in view page instead of id check functin in written here
    public function category()
    {
        # code...
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    // creating hasmany reln for product images
    public function productImages()
    {
        # code...
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    // create hasmany reln, prod has many colors
    public function productColors()
    {
        # code...
        // create productColor model , create migration
        
        return $this->hasMany(ProductColor::class, 'product_id', 'id');
    }
}
