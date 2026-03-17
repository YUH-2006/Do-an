<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function getCart(Request $request): array
    {
        return $request->session()->get('cart', []);
    }

    private function putCart(Request $request, array $cart): void
    {
        $request->session()->put('cart', $cart);
    }

    public function index(Request $request)
    {
        $cart = $this->getCart($request);

        $items = array_values($cart);
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

        $this->putCart($request, $cart);

        return back()->with('success', 'Đã thêm vào giỏ hàng.');
    }

    public function update(Request $request)
    {
        $cart = $this->getCart($request);
        $remove = $request->input('remove');
        if ($remove !== null) {
            $key = (string) $remove;
            if (isset($cart[$key])) {
                unset($cart[$key]);
                $this->putCart($request, $cart);
            }

            return redirect()
                ->route('cart.index')
                ->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
        }

        $qtys = (array) $request->input('qty', []);

        foreach ($qtys as $id => $qty) {
            $key = (string) $id;
            if (!isset($cart[$key])) {
                continue;
            }

            $q = (int) $qty;
            if ($q <= 0) {
                unset($cart[$key]);
            } else {
                $cart[$key]['qty'] = $q;
            }
        }

        $this->putCart($request, $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Đã cập nhật giỏ hàng.');
    }

    public function remove(Request $request, int $productId)
    {
        $cart = $this->getCart($request);
        $key = (string) $productId;

        if (isset($cart[$key])) {
            unset($cart[$key]);
            $this->putCart($request, $cart);
        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    public function clear(Request $request)
    {
        $request->session()->forget('cart');

        return redirect()
            ->route('cart.index')
            ->with('success', 'Đã xóa toàn bộ giỏ hàng.');
    }
}

