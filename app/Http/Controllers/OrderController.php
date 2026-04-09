<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private function currentUser(): ?User
    {
        $authUser = Auth::user();
        if ($authUser instanceof User) {
            return $authUser;
        }
        $sessionUser = session('user');
        return $sessionUser instanceof User ? $sessionUser : null;
    }

    public function index(Request $request)
    {
        $user = $this->currentUser();
        if (!$user) {
            return redirect()->route('login');
        }

        $orders = Order::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('orders.index', ['orders' => $orders]);
    }

    public function show(Order $order)
    {
        $user = $this->currentUser();
        if (!$user || $order->user_id !== $user->id) {
            return redirect()->route('products.index');
        }

        $order->load('items');

        return view('orders.show', ['order' => $order]);
    }
}
