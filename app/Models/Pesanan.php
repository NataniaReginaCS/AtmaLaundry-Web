<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_user',
        'id_layanan',
        'id_kategori',
        'tgl_order',
        'tgl_selesai',
        'status_pesanan',
        'total_bobot',
        'request',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user'); 
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan'); 
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori'); 
    }

    // public function admin()
    // {
    //     return $this->belongsTo(Admin::class, 'id_admin');  
    // }
    
    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'id_pesanan');  
    }

}
