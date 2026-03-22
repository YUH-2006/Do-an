<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CartItem;
use App\Models\User;
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
            // Gộp giỏ hàng session vào DB
            $sessionCart = session('cart', []);
            foreach ($sessionCart as $productId => $item) {
                $qty = (int) ($item['qty'] ?? 1);
                if ($qty < 1) continue;
                $row = CartItem::firstOrNew([
                    'user_id' => $user->id,
                    'product_id' => (int) $productId,
                ]);
                $row->qty = ($row->qty ?? 0) + $qty;
                $row->save();
            }
            session()->forget('cart');
            session(['user' => $user]);
            $intended = session('intended');
            if ($intended) {
                session()->forget('intended');
                return redirect($intended);
            }
            return redirect('/products');
        }

        return back()->with('error','Sai tài khoản hoặc mật khẩu');
    }

    public function logout() {
        session()->forget(['user','admin']);
        return redirect('/login');
    }
}
