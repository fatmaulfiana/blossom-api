<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Categories extends Model
{
    use HasFactory;

    protected $table = 'product_categories';

    protected $fillable = [
        'kategori',
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'category_id');
    }
}