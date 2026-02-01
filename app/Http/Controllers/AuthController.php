<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/login');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {

        // login admin
        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin' => $admin]);
            return redirect('/admin/admins');
        }

        // login user
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            session(['user' => $user]);
            return redirect('/products');
        }

        return back()->with('error','Sai tài khoản hoặc mật khẩu');
    }

    public function logout() {
        session()->forget(['user','admin']);
        return redirect('/login');
    }
}
