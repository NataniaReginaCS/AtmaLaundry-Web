<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\Balance;
use App\Models\Layanan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\TransaksiController;

class PesananController
{
    public function index()
    {
        $kategoris = Kategori::all();
        $layanans = Layanan::all();
        
        return view('user.orderForm', compact('kategoris', 'layanans'));
    }


    public function store(Request $request)
    {
        $request->merge(['id_user' => Auth::id()]);
        
        $request->merge(['status_pesanan' => 'pending']);

        $validatedData = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_layanan' => 'required|exists:layanans,id',
            'id_kategori' => 'required|exists:kategoris,id',
            'status_pesanan' => 'required|string',
            'total_bobot' => 'required|numeric|min:0',
            'request' => 'nullable|string',
        ]);

        try {
            $layanan = Layanan::findOrFail($validatedData['id_layanan']);

            $tanggalOrder = date('Y-m-d');
            $tanggalSelesai = date('Y-m-d', strtotime($tanggalOrder . " +{$layanan->durasi_layanan} days"));

            $validatedData['tgl_order'] = $tanggalOrder;
            $validatedData['tgl_selesai'] = $tanggalSelesai;
            
            $cost = $layanan['harga_layanan'] * $request->total_bobot;
            
            
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
                return redirect()->back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
            }
            
            $balance = Balance::where('id_akun', $id_akun)->first();
            if($balance->nominal < $cost) {
                return redirect()->back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
            } else {
                $pesanan = Pesanan::create($validatedData);
                
                $balanceRequest = new Request([
                    'cost' => $cost,
                ]);
                
                $transaksiRequest = new Request([
                    'id_pesanan' => $pesanan->id,
                    'metode_pembayaran' => 'E-money',
                    'total_harga' => $cost,
                ]);

                $transaksiController = new TransaksiController();
                $transaksiController->store($transaksiRequest);
                
                $balanceController = new BalanceController();
                $balanceController->transaction($balanceRequest);
            }
                                   
            return redirect()->route('orderList')->with('success', 'Order created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
    }

    public function orderList(Request $request)
    {

        $user = auth()->user();

        $orders = Pesanan::with(['kategori', 'layanan'])
            ->where('id_user', $user->id) 
            ->get();

        $orders->map(function ($order) {
            $order->remainingDays = isset($order->tgl_selesai) 
                ? Carbon::now()->diffInDays(Carbon::parse($order->tgl_selesai), false)
                : null;
            return $order;
        });


        $nama_kategori = $request->query('nama_kategori');

        if ($nama_kategori) {
            $orders = Pesanan::where('id_user', $user->id)
                ->whereHas('kategori', function ($query) use ($nama_kategori) {
                    $query->where('nama_kategori', $nama_kategori);
                })
                ->with(['layanan', 'kategori'])
                ->get();
        }

        return view('user.orderList', compact('orders', 'nama_kategori'));
    }


    public function orderDetail($id)
    {
        $pesanan = Pesanan::with(['kategori', 'layanan'])->findOrFail($id);

        $pesanan->durasi = (int) $pesanan->layanan->durasi_layanan;
        $pesanan->remainingDays = Carbon::parse($pesanan->tgl_order)->diffInDays(Carbon::parse($pesanan->tgl_selesai), false);

        return view('user.orderStatus', compact('pesanan'));
    }

}
