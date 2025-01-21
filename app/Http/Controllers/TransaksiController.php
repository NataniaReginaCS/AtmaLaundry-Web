<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Transaksi;
use App\Models\Balance;
use App\Models\Akun;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;

class TransaksiController
{
    public function index() {
        $transactions = Transaksi::all();
        return $transactions;
    }

    public function show($id) {
        $transaction = Transaksi::find($id)->first();
        return $transaction;
    }

    public function store(Request $request) {

        $transaction = Transaksi::create([
            'id_pesanan' => $request->id_pesanan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_harga' => $request->total_harga
        ]);

        $success = ['success' => 'Transaksi berhasil dibuat'];
        return $success;
    }

    public function update(Request $request) {
        $validateData = $request->validate([
            'id_pesanan' => 'required',
            'metode_pembayaran' => 'required',
            'total_harga' => 'required'
        ]);

        $transaction = Transaksi::where('id_pesanan', $validateData->id_pesanan);
        $transaction->update($validateData);

        $success = ['success' => 'Transaksi berhasil dibuat'];
        return $success;
    }

    public function destroy(Request $request) {
        try {
            $transaction = Transaksi::where('id_pesanan', $request->id_pesanan);
            if($transaction != null) $transaction->delete();
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus transaksi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
