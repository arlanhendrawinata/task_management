<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginLogs extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ip_address',
        'mac_address',
        'browser',
        'created_at',
        'logout_at',
        'updated_at'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userdetail()
    {
        return $this->hasOne(UserDetail::class);
    }
}
