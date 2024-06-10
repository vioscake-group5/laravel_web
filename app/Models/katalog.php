<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class katalog extends Model
{
    use HasFactory;
    
    protected $table = 'cakes';
    
    protected $fillable = [
        'nama_kue', 
        'deskripsi', 
        'harga', 
        'gambar'
    ];
}
