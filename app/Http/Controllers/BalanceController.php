<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Balance;
use App\Models\Akun;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController
{
    // get all data
    public function index() {
        // ambil semua balances
        $balances = Balance::all();

        // return data
        return $balance;
    }

    // get data by id
    public function show($id) {
        // cari balance id tertentu
        $balance = Balance::find($id)->first();

        // return error jika balance tdk ketemu
        if($balance == null) {
            $error = ['error' => 'Balance tidak ditemukan'];
            return $error;
        }

        // cari akun dengan id user balance
        $akun = Akun::find($balance->id_user);

        // return error jika akun tidak ada
        if($akun == null) {
            $error = ['error' => 'Akun tidak ditemukan'];
            return $error;
        }
        
        // return data jika didapat
        return $balance;
    }

    // get data by id user
    public function showMyBalance() {

        // get id akun
        if(Auth::guard('user')->user() != null) {
            $id = Auth::id();
            $user = User::find($id);
            $id_akun = $user['id_akun'];
        } else if(Auth::guard('admin')->user() != null) {
            $id = Auth::id();
            $admin = Admin::find($id);
            $id_akun = $admin['id_akun'];
        } else {
            $error = ['error' => 'Akun tidak ditemukan'];
            return $error;
        }

        // get akun
        $akun = Akun::find($id_akun);

        // return error jika ada
        if($akun == null) {
            $error = ['error' => 'Akun tidak ditemukan'];
            return $error;
        }

        // get balance
        $balance = Balance::where('id_akun', $id_akun)->first();
        
        // return error jika ada
        if($balance == null) {
            $error = ['error' => 'Balance tidak ditemukan'];
            return $error;
        }
        
        // kembalikan balance
        return $balance;
    }

    // insert data
    public function store(Request $request) {
        // validasi request
        $request->validate([
            'id_akun' => 'required',
            'nominal' => 'required',
        ]);

        // buat balance baru
        $balance = Balance::create([
            'id_akun' => $request->id_akun,
            'nominal' => $request->nominal,
        ]);

        // return success jika berhasil
        $success = ['success' => 'Balance berhasil dibuat'];
        return $success;
    }

    
    public function transaction(Request $request)
{
    try {
        // Ambil ID akun berdasarkan role (user atau admin)
        if (Auth::guard('user')->check()) {
            $id = Auth::id();
            $user = User::find($id);
            $id_akun = $user['id_akun'];
        } else if (Auth::guard('admin')->check()) {
            $id = Auth::id();
            $admin = Admin::find($id);
            $id_akun = $admin['id_akun'];
        } else {
            return ['error' => 'Akun tidak ditemukan'];
        }
        
        $id_balance_admin = 2; // ID balance admin yang ingin diperbarui

        // Ambil balance user dan balance admin
        $balance = Balance::where('id_akun', $id_akun)->first();
        $adminBalance = Balance::find($id_balance_admin);

        // Periksa apakah balance ditemukan
        if (!$balance || !$adminBalance) {
            return ['error' => 'Balance tidak ditemukan'];
        }

        // Update nominal balance
        $balance->nominal -= $request->cost; // Kurangi nominal user
        $adminBalance->nominal += $request->cost; // Tambahkan nominal admin

        // Simpan perubahan ke database
        $balance->save();
        $adminBalance->save();

        return ['success' => 'Data balance berhasil diupdate'];
    } catch (Exception $e) {
        // Return jika terjadi error
        return ['error' => 'Gagal mengupdate balance: ' . $e->getMessage()];
    }
}


    // destroy data
    public function destroy() {

        try {
            // get id akun
            if(Auth::guard('user')->user() != null) {
                $id = Auth::id();
                $user = User::find($id);
                $id_akun = $user['id_akun'];
            } else if(Auth::guard('admin')->user() != null) {
                $id = Auth::id();
                $admin = Admin::find($id);
                $id_akun = $admin['id_akun'];
            } else {
                $error = ['error' => 'Akun tidak ditemukan'];
                return $error;
            }

            // get balance
            $balance = Balance::where('id_akun', $id_akun);

            // return error jika ada
            if($balance == null) {
                $error = ['error' => 'Balance tidak ditemukan'];
                return $error;
            }

            // get akun
            $akun = Akun::find($id_akun);

            // return error jika ada
            if($akun == null) {
                $error = ['error' => 'Akun tidak ditemukan'];
                return $error;
            }

            // hapus balance
            $balance->delete();

            // return success jika berhasil
            $success = ['success' => 'Data berhasil dihapus'];
            return $success;
        } catch (Exception $e) {
            // return jika error
            $error = ['error' => `Gagal menghapus balance: $e`];
            return $error;
        }

    }
}
