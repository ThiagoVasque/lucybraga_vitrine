<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'category', 'brand', 'size', 'description', 'price', 'is_active'];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
