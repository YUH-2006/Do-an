<?php

namespace App\Http\Controllers;

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

    private function getCartFromSession(Request $request): array
    {
        return $request->session()->get('cart', []);
    }

    private function putCartToSession(Request $request, array $cart): void
    {
        $request->session()->put('cart', $cart);
    }

    /** @return array<array{id:int,name:string,price:int,image:?string,qty:int}> */
    private function getCartItems(Request $request): array
    {
        $user = $this->currentUser();

        if ($user) {
            $rows = CartItem::where('user_id', $user->id)->with('product')->get();
            return $rows->map(function (CartItem $row) {
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

        $cart = $this->getCartFromSession($request);
        return array_values($cart);
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

        $user = $this->currentUser();

        if ($user) {
            $item = CartItem::firstOrNew([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
            $item->qty = ($item->qty ?? 0) + $qty;
            $item->save();
        } else {
            $cart = $this->getCartFromSession($request);
            $key = (string) $product->id;
            if (isset($cart[$key])) {
                $cart[$key]['qty'] = (int) $cart[$key]['qty'] + $qty;
            } else {
                $cart[$key] = [
                    'id' => (int) $product->id,
                    'name' => (string) $product->name,
                    'price' => (int) $product->price,
                    'image' => $product->image ? (string) $product->image : null,
                    'qty' => $qty,
                ];
            }
            $this->putCartToSession($request, $cart);
        }

        return back()->with('success', 'Đã thêm vào giỏ hàng.');
    }

    public function update(Request $request)
    {
        $user = $this->currentUser();

        if ($user) {
            $remove = $request->input('remove');
            if ($remove !== null) {
                CartItem::where('user_id', $user->id)
                    ->where('product_id', (int) $remove)
                    ->delete();
                return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
            }

            $qtys = (array) $request->input('qty', []);
            foreach ($qtys as $id => $qty) {
                $item = CartItem::where('user_id', $user->id)->where('product_id', (int) $id)->first();
                if (!$item) continue;
                $q = (int) $qty;
                if ($q <= 0) {
                    $item->delete();
                } else {
                    $item->qty = $q;
                    $item->save();
                }
            }
        } else {
            $cart = $this->getCartFromSession($request);
            $remove = $request->input('remove');
            if ($remove !== null) {
                $key = (string) $remove;
                if (isset($cart[$key])) {
                    unset($cart[$key]);
                    $this->putCartToSession($request, $cart);
                }
                return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
            }

            $qtys = (array) $request->input('qty', []);
            foreach ($qtys as $id => $qty) {
                $key = (string) $id;
                if (!isset($cart[$key])) continue;
                $q = (int) $qty;
                if ($q <= 0) {
                    unset($cart[$key]);
                } else {
                    $cart[$key]['qty'] = $q;
                }
            }
            $this->putCartToSession($request, $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Đã cập nhật giỏ hàng.');
    }

    public function remove(Request $request, int $productId)
    {
        $user = $this->currentUser();

        if ($user) {
            CartItem::where('user_id', $user->id)->where('product_id', $productId)->delete();
        } else {
            $cart = $this->getCartFromSession($request);
            $key = (string) $productId;
            if (isset($cart[$key])) {
                unset($cart[$key]);
                $this->putCartToSession($request, $cart);
            }
        }

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    public function clear(Request $request)
    {
        $user = $this->currentUser();

        if ($user) {
            CartItem::where('user_id', $user->id)->delete();
        } else {
            $request->session()->forget('cart');
        }

        return redirect()->route('cart.index')->with('success', 'Đã xóa toàn bộ giỏ hàng.');
    }
}
