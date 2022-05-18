<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nama_divisi',
        'keterangan',
        'status',
    ];

    public function projects()
    {
        return $this->hasOne(Projects::class);
    }
}
