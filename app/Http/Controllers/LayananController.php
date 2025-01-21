<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController
{

    public function index() {
        $layanans = Layanan::all();
        return view('user.serviceList', compact('layanans'));
    }


}