<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address'; 

    protected $fillable = [
        'user_id',
        'nama_penerima',
        'nomor_hp',
        'alamat_lengkap',
        'kota',
        'kode_pos',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}