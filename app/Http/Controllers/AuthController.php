<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        // cek user + password
        if ($user && Hash::check($request->password, $user->password)) {

            // simpan session login
            session([
                'user_id' => $user->id,
                'user_name' => $user->name
            ]);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    // REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Akun berhasil dibuat, silakan login!');
    }

    // LOGOUT
    public function logout()
    {
        session()->flush();
        return redirect('/login')->with('success', 'Berhasil logout');
    }
}
