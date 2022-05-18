<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'detail',
        'img',
        'value',
        'type',
        'offices_id',
        'users_id',
        'status',
    ];
}
