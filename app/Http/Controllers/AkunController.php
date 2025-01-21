<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Akun;
use App\Models\User;
use App\Models\Admin;
use App\Models\Balance;
use App\Http\Controllers\BalanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Facades\Auth; 

class AkunController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            // 'email' => 'required|email',
            'tanggal_lahir' => 'required|date',
        ]);

        try {
            $akun = Akun::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'user', 
            ]);

            $user = User::create([
                'id_akun' => $akun->id,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'email' => 0,
                'tanggal_lahir' => $request->tanggal_lahir,
                'point' => 0, 
            ]);

            // Panggil fungsi store di BallanceController untuk menambahkan balance
            $balanceController = new BalanceController();
            $balanceRequest = new Request([
                'id_akun' => $user->id_akun,
                'nominal' => 100000, // ambil nominal dari input
            ]);

            $balanceController->store($balanceRequest);

            return redirect('/login')->with('success', 'User berhasil dibuat. Silakan login.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal membuat akun: ' . $e->getMessage()]);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $akun = Akun::where('username', $request->username)->first();

        if (!$akun || !Hash::check($request->password, $akun->password)) {
            return redirect()->back()->withErrors(['error' => 'Username atau password salah.']);
        }

        if ($akun->role == 'admin') {
            $admin = Admin::where('id_akun', $akun->id)->first();
            Auth::guard('admin')->login($admin);
            return redirect()->intended('adminDashboard')->with('success', 'Berhasil login');
        } else {
            $user = User::where('id_akun', $akun->id)->first();
            Auth::guard('user')->login($user);
            return redirect()->intended('userDashboard')->with('success', 'Berhasil login');
        }
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else {
            Auth::guard('user')->logout();
        }
        return redirect('/')->with('success', 'Berhasil logout.');
    }
}
