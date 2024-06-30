<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class katalogDesign extends Model
{
    use HasFactory;
    
    protected $table = 'desains';
    
    protected $fillable = [
        // 'design', 
        // 'deskripsi', 
        'harga', 
        'gambar'
    ];
}
