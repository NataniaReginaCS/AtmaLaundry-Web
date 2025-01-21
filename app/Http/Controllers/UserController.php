<?php

namespace App\Http\Controllers;


use Exception;
use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Auth::guard('user')->user();
            return view('user.profile', compact('user')); 
        } catch (Exception $e) {
            return redirect()->route('home')->with('error', 'Gagal mengambil data user');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'nama' => 'required',
                'alamat' => 'required',
                'telepon' => 'required',
                'email' => 'required|email',
                'tanggal_lahir' => 'required|date',
            ]);

            $akunId = Auth::id();
            if (!$akunId) {
                return redirect()->route('login')->with('error', 'User belum terautentikasi');
            }

            $user = User::create([
                'id_akun' => $akunId,
                'nama' => $validateData['nama'],
                'alamat' => $validateData['alamat'],
                'telepon' => $validateData['telepon'],
                'email' => $validateData['email'],
                'tanggal_lahir' => $validateData['tanggal_lahir'],
                'point' => 0, 
            ]);

            return redirect()->route('user.profile')->with('success', 'User berhasil dibuat');
        } catch (Exception $e) {
            return redirect()->route('user.profile')->with('error', 'Gagal membuat user');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $user = User::find($id);
            if (!$user || $user->id_akun != Auth::id()) {
                return redirect()->route('home')->with('error', 'User tidak ditemukan atau tidak memiliki akses');
            }

            return view('user.profile', ['user' => $user]);
        } catch (Exception $e) {
            return redirect()->route('home')->with('error', 'Gagal menampilkan data user');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::guard('user')->user();
        try {
            $validateData = $request->validate([
                'nama' => 'required',
                'alamat' => 'required',
                'telepon' => 'required',
            ]);

            $user->update($validateData);
            return redirect()->route('user.profile')->with('success', 'User berhasil diupdate');
        } catch (Exception $e) {
            return redirect()->route('user.profile')->with('error', 'Gagal mengupdate user');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if (!$user || $user->id_akun != Auth::id()) {
                return redirect()->route('home')->with('error', 'User tidak ditemukan atau tidak memiliki akses');
            }

            $user->delete();
            return redirect()->route('home')->with('success', 'User berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->route('home')->with('error', 'Gagal menghapus user');
        }
    }

    // public function Dashboard()
    // {
    //     try {
    //         $user = Auth::guard('user')->user(); 
    //         $recentOrders = Pesanan::where('id_user', $user->id)  
    //             ->with(['layanan', 'kategori']) 
    //             ->orderBy('tgl_order', 'desc') 
    //             ->take(4) 
    //             ->get();

    //         return view('user.index', compact('user', 'recentOrders'));  
    //     } catch (Exception $e) {
    //         return redirect()->route('home')->with('error', 'Gagal mengambil data user');
    //     }
    // }

    public function dashboard()
    {
        $user = Auth::guard('user')->user();
        
        $recentOrders = Pesanan::select('id', 'id_layanan', 'total_bobot', 'status_pesanan', 'tgl_order')
            ->where('id_user', $user->id)
            ->with('layanan:id,nama_layanan,harga_layanan')
            ->orderBy('tgl_order', 'desc')
            ->take(4)
            ->get();

        return $recentOrders;

    }


}
