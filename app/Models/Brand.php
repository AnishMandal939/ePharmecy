<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    // your code
    // connect table
    protected $table = 'brands';

    protected $fillable = [
        'name',
        'slug',
        'status',
        'category_id',

        // now create livewire for this
    ];

    // creating reln
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
