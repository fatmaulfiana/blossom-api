<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'deskripsi', 'harga', 'stok', 'kategori', 'gambar'
    ];

    public function category()
    {
        return $this->belongsTo(Product_Categories::class);
    }
}
