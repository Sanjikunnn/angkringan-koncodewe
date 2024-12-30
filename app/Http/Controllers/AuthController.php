<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;
use Hash;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        };
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input yang datang dari pengguna
        $request->validate([
            'phone' => 'required|string', // atau name jika menggunakan name
            'name' => 'required|string', // atau name jika menggunakan name
        ]);

        // Cek apakah input `phone` atau `name` ditemukan di database
        $user = User::where('name', $request->name)->orWhere('phone', $request->phone)->first();

        // Jika user ditemukan, login otomatis tanpa password
        if ($user) {
            Auth::login($user);
            return redirect()->route('home');
        }

        // Jika tidak ditemukan, kirimkan error
        return back()->withErrors(['message' => 'User not found.']);
    }

    public function showFormRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'phone' => 'required|number',
        ];

        $messages = [
            'name.required' => 'Nama wajib diisi',
            'name.string' => 'Nama harus berupa string',
            'phone.required' => 'Nomor WhatsApp wajib diisi',
            'phone.number' => 'Nomor WhatsApp harus berupa angka',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = new User;
        $user->name = ($request->name);
        $user->phone = ($request->phone);
        $check = $user->save();

        if ($check) {
            Session::flash('success', 'Register berhasil! Silahkan login untuk masuk ke sistem');
            return redirect()->route('login');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('register');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
