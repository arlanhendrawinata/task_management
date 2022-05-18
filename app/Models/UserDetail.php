<?php

namespace App\Models;

use App\Models\company as ModelsCompany;
// use Faker\Provider\ar_EG\Companies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'perusahaan_id',
        'divisi_id',
        'role',
        'no_telp',
        'alamat',
        'nip',
        'foto',
        'status',

    ];

    // public function users()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
    public function companies()
    {
        return $this->belongsTo(Company::class, 'perusahaan_id');
    }
    public function divisions()
    {
        return $this->belongsTo(Division::class, 'divisi_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
