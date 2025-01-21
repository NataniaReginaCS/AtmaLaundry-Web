<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_kategori',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_kategori');  
    }

    // public function admin()
    // {
    //     return $this->belongsTo(Admin::class, 'id_admin'); 
    // }
    
}
