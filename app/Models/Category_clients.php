<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_clients extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_kategori',
        'status',
    ];
}
