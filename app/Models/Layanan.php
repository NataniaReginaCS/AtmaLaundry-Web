<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanans';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_layanan',
        'harga_layanan',
        'bobot_layanan',
        'durasi_layanan',
        'isi_layanan',
        'deskripsi_layanan',
        'keterangan_layanan'
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_layanan');  
    }
    
    // public function admin()
    // {
    //     return $this->belongsTo(Admin::class, 'id_admin');  
    // }
}
