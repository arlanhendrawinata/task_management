<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companyclient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'alamat',
        'status',
    ];
}
