<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    private const PAYMENT_METHODS = [
        'cod' => 'Tiền mặt khi nhận hàng (COD)',
        'bank' => 'Chuyển khoản ngân hàng',
    ];

    private function currentUser(): ?User
    {
        $authUser = Auth::user();
        if ($authUser instanceof User) {
            return $authUser;
        }
        $sessionUser = session('user');
        return $sessionUser instanceof User ? $sessionUser : null;
    }

    private function getCartItems(Request $request): array
    {
        $user = $this->currentUser();
        if ($user) {
            $rows = CartItem::where('user_id', $user->id)->with('product')->get();
            return $rows->map(fn(CartItem $r) => [
                'id' => (int) $r->product->id,
                'name' => (string) $r->product->name,
                'price' => (int) $r->product->price,
                'image' => $r->product->image ? (string) $r->product->image : null,
                'qty' => (int) $r->qty,
            ])->all();
        }
        $cart = $request->session()->get('cart', []);
        return array_values($cart);
    }

    public function index(Request $request)
    {
        $user = $this->currentUser();
        if (!$user) {
            return redirect()->route('login')->with('intended', route('checkout.index'));
        }

        $items = $this->getCartItems($request);
        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống. Vui lòng thêm sản phẩm trước khi thanh toán.');
        }

        $total = array_reduce($items, fn($c, $i) => $c + (($i['price'] ?? 0) * ($i['qty'] ?? 0)), 0);

        return view('checkout.index', [
            'items' => $items,
            'total' => $total,
            'user' => $user,
            'paymentMethods' => self::PAYMENT_METHODS,
        ]);
    }

    public function store(Request $request)
    {
        $user = $this->currentUser();
        if (!$user) {
            return redirect()->route('login')->with('intended', route('checkout.index'));
        }

        $items = $this->getCartItems($request);
        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        $validated = $request->validate([
            'shipping_name' => ['required', 'string', 'max:255'],
            'shipping_phone' => ['required', 'string', 'max:20'],
            'shipping_address' => ['required', 'string', 'max:500'],
            'payment_method' => ['required', 'string', 'in:' . implode(',', array_keys(self::PAYMENT_METHODS))],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        $total = array_reduce($items, fn($c, $i) => $c + (($i['price'] ?? 0) * ($i['qty'] ?? 0)), 0);

        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'pending',
            'shipping_name' => $validated['shipping_name'],
            'shipping_phone' => $validated['shipping_phone'],
            'shipping_address' => $validated['shipping_address'],
            'payment_method' => $validated['payment_method'],
            'note' => $validated['note'] ?? null,
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'price' => $item['price'],
                'qty' => $item['qty'],
            ]);
        }

        CartItem::where('user_id', $user->id)->delete();
        $request->session()->forget('cart');

        return redirect()->route('checkout.success', $order->id);
    }

    public function success(Order $order)
    {
        $user = $this->currentUser();
        if (!$user || $order->user_id !== $user->id) {
            return redirect()->route('products.index');
        }

        return view('checkout.success', ['order' => $order->load('items')]);
    }
}
