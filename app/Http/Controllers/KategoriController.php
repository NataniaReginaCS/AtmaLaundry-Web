<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController
{

    public function index() {
        $kategoris = Kategori::all();
        return view('user.index', compact('kategoris'));
    }


}