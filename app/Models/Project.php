<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Company;
use App\Models\Division;
use App\Models\User;
use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'divisi_id',
        'user_id',
        'perusahaan_id',
        'judul_project',
        'detail_project',
        'tgl_input',
        'tgl_mulai',
        'estimasi',
        'tgl_selesai',
        'status',
        'prioritas',
        'total_revisi',
        'laporan_project',
        'debet',
        'kredit',
        'foto_hasil',
        'is_parent',
        'type',
        'project_id',
        'project_id_2',
    ];

    public function companies()
    {
        return $this->belongsTo(Company::class, 'perusahaan_id');
    }
    public function clients()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function divisions()
    {
        return $this->belongsTo(Division::class, 'divisi_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function pics()
    {
        return $this->hasMany(Pic::class);
    }
    public function notes()
    {
        return $this->hasOne(Note::class);
    }
}
