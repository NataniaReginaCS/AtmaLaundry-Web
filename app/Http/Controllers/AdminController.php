<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Akun;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use Carbon\Carbon;
use App\Http\Controllers\TransaksiController;

use Exception;
use App\Models\Layanan;


class AdminController extends Controller
{
    /**
     * Tampilkan daftar admin
     */
    public function index()
    {
        $admins = Admin::with('akun')->latest()->get();
        return view('admin.index', compact('admins'));
    }

    /**
     * Simpan admin baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required|string|max:255',
            'akun_id' => 'required|exists:akuns,id', 
        ]);

        $admin = Admin::create([
            'jabatan' => $request->jabatan,
            'id_akun' => $request->akun_id, 
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan');
    }

    /**
     * Menampilkan data admin berdasarkan ID
     */
    public function show($id)
    {
        try {
            $admin = Admin::join('akuns', 'admins.id_akun', '=', 'akuns.id')
                ->select('admins.*', 'akuns.username', 'akuns.email')
                ->where('admins.id', $id)
                ->first();

            if (!$admin) {
                return redirect()->route('admin.index')->with('error', 'Admin tidak ditemukan');
            }

            return view('admin.show', compact('admin'));
        } catch (Exception $e) {
            return redirect()->route('admin.index')->with('error', 'Gagal mengambil data admin');
        }
    }

    /**
     * Menghapus admin berdasarkan ID
     */
    public function destroy($id)
    {
        try {
            $admin = Admin::find($id);

            if (!$admin) {
                return redirect()->route('admin.index')->with('error', 'Admin tidak ditemukan');
            }
            $admin->delete();
            return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->route('admin.index')->with('error', 'Gagal menghapus admin');
        }
    }

    public function showCustomerList(Request $request)
    {
        try {
            $searchId = $request->input('searchId');

            $query = User::query();

            if ($searchId) {
                $query->where('id', 'like', '%' . $searchId . '%');
            }

            $users = $query->get();

            return view('admin.customerList', compact('users'))->with('success', 'Successfully displayed customers');
        } catch (Exception $e) {
            return redirect()->route('admin.index')->with('error', 'Failed to show customers');
        }
    }


    public function showLayanan()
    {
        try {
            $layanans = Layanan::all();
            
            return view('admin.serviceList', compact('layanans'))->with('success', 'berhasil membuka layanan');
        } catch (Exception $e) {
            return redirect()->route('admin.index')->with('error', 'Gagal membuka layanan');
        }
    }

    public function showCreate()
    {
        try {
            $layanans = Layanan::all();
            
            return view('admin.newServiceList', compact('layanans'))->with('success', 'berhasil membuka layanan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuka create layanan');
        }
    }

    public function showEdit($id)
    {
        
        try {
            $layanans2 = Layanan::find($id);
            
            
            return view('admin.editServiceList', compact( 'layanans2'))->with('success', 'berhasil membuka layanan');
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Gagal membuka edit layanan');
        }
    }

    public function createLayanan(Request $request)
    {
        try {
            $request->validate([
                'nama_layanan' => 'required|string|max:255',
                'durasi_layanan' => 'required', 
                'harga_layanan' => 'required', 
                'isi_layanan' => 'required|string|max:255', 
                'deskripsi_layanan' => 'required|string|max:255', 
                'keterangan_layanan' => 'required|string|max:255', 
            ]);
            
            $layanans = Layanan::create([
                'nama_layanan' => $request->nama_layanan,
                'durasi_layanan' => $request->durasi_layanan, 
                'harga_layanan' => $request->harga_layanan, 
                'isi_layanan' => $request->isi_layanan, 
                'deskripsi_layanan' => $request->deskripsi_layanan, 
                'keterangan_layanan' => $request->keterangan_layanan, 
                'bobot_layanan' => 0
            ]);

            return redirect()->route('admin.serviceList')->with('success', 'Layanan berhasil ditambahkan');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambah layanan');
        }

    }

    public function editLayanan(Request $request, $id)
    {
        $layanans = Layanan::find($id);
        
        try {
            $request->validate([
                'nama_layanan' => 'required|string|max:255',
                'durasi_layanan' => 'required', 
                'harga_layanan' => 'required', 
                'isi_layanan' => 'required|string|max:255', 
                'deskripsi_layanan' => 'required|string|max:255', 
                'keterangan_layanan' => 'required|string|max:255', 
            ]);
            
            $layanans->update([
                'nama_layanan' => $request->nama_layanan,
                'durasi_layanan' => $request->durasi_layanan, 
                'harga_layanan' => $request->harga_layanan, 
                'isi_layanan' => $request->isi_layanan, 
                'deskripsi_layanan' => $request->deskripsi_layanan, 
                'keterangan_layanan' => $request->keterangan_layanan, 
                'bobot_layanan' => 0
            ]);

            return redirect()->route('admin.serviceList')->with('success', 'Layanan berhasil ditambahkan');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambah layanan');
        }

    }

    public function destroyLayanan($id)
    {
        try {
            $layanans = Layanan::find($id);

            if (!$layanans) {
                dd($layanans);
                return redirect()->back()->with('error', 'Admin tidak ditemukan');
            }

            $layanans->delete();
           
            return redirect()->route('admin.serviceList')->with('success', 'Admin berhasil dihapus');
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Gagal menghapus admin');
        }

    }


    public function showOrderList(Request $request)
    {
        $searchId = $request->input('searchId');
        $nama_kategori = $request->query('nama_kategori');

        $query = Pesanan::with(['layanan', 'kategori', 'user']);

        if ($searchId) {
            $query->where('id', 'like', '%' . $searchId . '%');
        }

        if ($nama_kategori) {
            $query->whereHas('kategori', function ($query) use ($nama_kategori) {
                $query->where('nama_kategori', $nama_kategori);
            });
        }

        $orders = $query->get();

        $orders->map(function ($order) {
            $order->remainingDays = isset($order->tgl_selesai) 
                ? Carbon::now()->diffInDays(Carbon::parse($order->tgl_selesai), false)
                : null;
            return $order;
        });

        return view('admin.orderList', compact('orders', 'nama_kategori'));
    }



    public function deleteOrder(Request $request, $orderId)
    {
        $request->validate([
            'password' => 'required|string',
        ]);
        
        $loggedInUser = Auth::user();

        $akun = Akun::find($loggedInUser->id_akun);

        if (!$akun) {
            return response()->json([
                'success' => false,
                'message' => 'Akun tidak ditemukan.',
            ], 404);
        }

        if (!Hash::check($request->password, $akun->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password yang Anda masukkan salah.',
            ], 403);
        }

        $order = Pesanan::findOrFail($orderId);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan.',
            ], 404);
        }

        try {
            $transaksiController = new TransaksiController();
            $transaksiRequest = new Request([
                'id_pesanan' => $orderId,
            ]);
            $transaksiController->destroy($transaksiRequest);
            $order->delete();

            return response()->json([
                'success' => true,
                'message' => 'order berhasil dihapus.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus order.',
                'error' => $e->getMessage(),
            ], 500);
        }
        
    }

    public function updateStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:on delivery,pickup,folding,ironing,dry_wash',
        ]);

        $order = Pesanan::findOrFail($orderId);
        $order->status_pesanan = $request->status;
        $order->save();

        return response()->json(['success' => true]);
    }

    public function editUser(Request $request, $userId)
    {
        $request->validate([
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($userId);
        $user->telepon = $request->telepon;
        $user->alamat = $request->alamat;
        $user->save();

        return response()->json(['success' => true]);
    }

    public function deleteUser(Request $request, $userId)
    {
        $request->validate([
            'password' => 'required|string',
        ]);
        
        $loggedInUser = Auth::user();

        $akun = Akun::find($loggedInUser->id_akun);

        if (!$akun) {
            return response()->json([
                'success' => false,
                'message' => 'Akun tidak ditemukan.',
            ], 404);
        }

        if (!Hash::check($request->password, $akun->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password yang Anda masukkan salah.',
            ], 403);
        }

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan.',
            ], 404);
        }

        try {
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User berhasil dihapus.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus user.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function dashboard()
    {
        $recentOrders = Pesanan::select('id', 'id_layanan', 'total_bobot', 'status_pesanan', 'tgl_order')
                        ->with(['layanan' => function ($query) {
                            $query->select('id', 'nama_layanan', 'harga_layanan');
                        }])
                        ->orderBy('tgl_order', 'desc')
                        ->take(4)
                        ->get();

        return $recentOrders;
    }



}
