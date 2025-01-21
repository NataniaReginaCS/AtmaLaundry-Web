<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'admins';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_akun',
        'jabatan',
    ];

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'id_akun'); 
    }

    // public function layanan()
    // {
    //     return $this->hasMany(Layanan::class, 'id_admin'); 
    // }

    // public function kategori()
    // {
    //     return $this->hasMany(Kategori::class, 'id_admin'); 
    // }

    // public function pesanan()
    // {
    //     return $this->hasMany(Pesanan::class, 'id_admin');
    // }
    

}
