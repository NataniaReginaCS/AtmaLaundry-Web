<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Akun extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'akuns';
    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id_akun'); 
    }
    
    public function user()
    {
        return $this->hasOne(User::class, 'id_akun'); 
    }

    public function balance()
    {
        return $this->hasOne(Balance::class, 'id_akun'); 
    }
}
