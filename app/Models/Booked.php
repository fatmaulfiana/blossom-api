<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booked extends Model
{
    use HasFactory;

    protected $table = 'booked';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'booked_date',
    ];

    protected $casts = [
        'booked_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}