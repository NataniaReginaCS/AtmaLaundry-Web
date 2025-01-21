<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_akun',
        'nama',
        'alamat',
        'telepon',
        'email',
        'tanggal_lahir',
        'point',
    ];

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'id_akun'); 
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_user'); 
    }

}
