<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // menampilkan semua data pesanan pelanggan
    public function getOrders(Auth $auth)
    {
        $user = $auth::user();
        if ($user->role == 0) {
            return redirect()->route('home');
        }
        $data = [
            'user' => $user,
            'orders' => Order::whereIn('status', ['proses','siap'])->get()
        ];
        return view('admin.orders', compact('data'));
    }
    // merubah status pemesanan
    public function setStatus(Auth $auth, $id, $status)
    {
        date_default_timezone_set('Asia/Jakarta');
        $user = $auth::user();
        if ($user->role == 0) {
            return redirect()->route('home');
        }
        Order::where('id', $id)->update([
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()
            ->route('orders.admin')
            ->with('success', 'edit status pesanan ke '. $status .' berhasil');
    }
    // menampilkan data pemantauan pesanan
    public function getPayments(Auth $auth)
    {
        $user = $auth::user();
        if ($user->role == 0) {
            return redirect()->route('home');
        }
        $data = [
            'user' => $user,
            'payments' => Payment::where('status', 'settlement')->get(),
        ];
        return view('admin.payments', compact('data'));
    }
    
    // menampilkan data pesanan yang telah selesai
    public function getCompleted(Auth $auth)
    {
        $user = $auth::user();
        if ($user->role == 0) {
            return redirect()->route('home');
        }
        $data = [
            'user' => $user,
            'orders' => Order::whereIn('status', ['selesai'])->get()
        ];
        return view('admin.completed', compact('data'));
    }

    // menampilkan data pelanggan
    public function getUsers(Auth $auth)
    {
        $user = $auth::user();
        if ($user->role == 0) {
            return redirect()->route('home');
        }
        $data = [
            'user' => $user,
            'users' => User::whereIn('role', [0])->get()
        ];
        return view('admin.users', compact('data'));
    }
}
