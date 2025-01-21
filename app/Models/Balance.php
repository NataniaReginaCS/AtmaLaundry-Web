<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Balance extends Model
{
    use HasFactory;

    protected $table = 'balances';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_akun',
        'nominal',
    ];

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'id_akun'); 
    }

}
