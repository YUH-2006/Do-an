<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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

    /** @return Cart|array<string, mixed> */
    private function getCart(Request $request)
    {
        $user = $this->currentUser();

        if ($user) {
            return Cart::firstOrCreate(['user_id' => $user->id]);
        }

        // Đối với khách, dùng session_id hoặc session data cũ
        $sessionId = $request->session()->getId();
        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }

    /** @return array<array{id:int,name:string,price:int,image:?string,qty:int}> */
    private function getCartItems(Request $request): array
    {
        $cart = $this->getCart($request);

        if ($cart instanceof Cart) {
            return $cart->items()->with('product')->get()->map(function (CartItem $row) {
                $p = $row->product;
                return [
                    'id' => (int) $p->id,
                    'name' => (string) $p->name,
                    'price' => (int) $p->price,
                    'image' => $p->image ? (string) $p->image : null,
                    'qty' => (int) $row->qty,
                ];
            })->all();
        }

        return [];
    }

    public function index(Request $request)
    {
        $items = $this->getCartItems($request);
        $total = array_reduce($items, function ($carry, $item) {
            return $carry + (($item['price'] ?? 0) * ($item['qty'] ?? 0));
        }, 0);

        return view('cart.index', [
            'items' => $items,
            'total' => $total,
        ]);
    }

    public function add(Request $request, int $productId)
    {
        $product = Product::findOrFail($productId);

        $qty = (int) $request->input('qty', 1);
        if ($qty < 1) {
            $qty = 1;
        }

        $cart = $this->getCart($request);

        if ($cart instanceof Cart) {
            $item = CartItem::firstOrNew([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
            ]);
            $item->qty = ($item->qty ?? 0) + $qty;
            $item->save();
        }

        return back()->with('success', 'Đã thêm vào giỏ hàng.');
    }

    public function update(Request $request)
    {
        $cart = $this->getCart($request);

        if ($cart instanceof Cart) {
            $remove = $request->input('remove');
            if ($remove !== null) {
                CartItem::where('cart_id', $cart->id)
                    ->where('product_id', (int) $remove)
                    ->delete();
                return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
            }

            $qtys = (array) $request->input('qty', []);
            foreach ($qtys as $id => $qty) {
                $item = CartItem::where('cart_id', $cart->id)->where('product_id', (int) $id)->first();
                if (!$item) continue;
                $q = (int) $qty;
                if ($q <= 0) {
                    $item->delete();
                } else {
                    $item->qty = $q;
                    $item->save();
                }
            }
        }

        return redirect()->route('cart.index')->with('success', 'Đã cập nhật giỏ hàng.');
    }

    public function remove(Request $request, int $productId)
    {
        $cart = $this->getCart($request);

        if ($cart instanceof Cart) {
            CartItem::where('cart_id', $cart->id)->where('product_id', $productId)->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    public function clear(Request $request)
    {
        $cart = $this->getCart($request);

        if ($cart instanceof Cart) {
            CartItem::where('cart_id', $cart->id)->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Đã xóa toàn bộ giỏ hàng.');
    }
}
