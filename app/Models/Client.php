<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'perusahaan_id',
        'kategori_client_id',
        'companyclient_id',
        'user_id',
        'nama_client',
        'nama_company',
        'no_telp',
        'alamat',
        'status',
        'logo',
        'created_at',


    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function companies()
    {
        return $this->belongsTo(Company::class, 'perusahaan_id');
    }
    public function category_clients()
    {
        return $this->belongsTo(Category_clients::class, 'kategori_client_id');
    }
    public function companyclients()
    {
        return $this->belongsTo(Companyclient::class, 'companyclient_id');
    }
}
