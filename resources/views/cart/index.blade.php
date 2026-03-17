@extends('layouts.app')

@section('content')
    <h1>Giỏ hàng</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (count($items) === 0)
        <p>Giỏ hàng của bạn đang trống.</p>
        <a href="{{ route('products.index') }}">
            <button>Tiếp tục mua hàng</button>
        </a>
    @else
        <form method="POST" action="{{ route('cart.update') }}">
            @csrf

            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                <tr>
                    <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Sản phẩm</th>
                    <th style="text-align: right; padding: 8px; border-bottom: 1px solid #ddd;">Đơn giá</th>
                    <th style="text-align: center; padding: 8px; border-bottom: 1px solid #ddd;">Số lượng</th>
                    <th style="text-align: right; padding: 8px; border-bottom: 1px solid #ddd;">Thành tiền</th>
                    <th style="padding: 8px; border-bottom: 1px solid #ddd;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #eee;">
                            <div style="display:flex; gap:12px; align-items:center;">
                                @if(!empty($item['image']))
                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" style="width:64px; height:64px; object-fit:cover; border-radius:8px;">
                                @endif
                                <div>
                                    <div style="font-weight:600;">{{ $item['name'] }}</div>
                                    <a href="{{ route('products.show', $item['id']) }}">Xem chi tiết</a>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 8px; border-bottom: 1px solid #eee; text-align:right;">
                            {{ number_format($item['price']) }} VND
                        </td>
                        <td style="padding: 8px; border-bottom: 1px solid #eee; text-align:center;">
                            <input
                                type="number"
                                min="0"
                                name="qty[{{ $item['id'] }}]"
                                value="{{ $item['qty'] }}"
                                style="width:80px; padding:6px;"
                            />
                        </td>
                        <td style="padding: 8px; border-bottom: 1px solid #eee; text-align:right;">
                            {{ number_format($item['price'] * $item['qty']) }} VND
                        </td>
                        <td style="padding: 8px; border-bottom: 1px solid #eee; text-align:right;">
                            <button type="submit" name="remove" value="{{ $item['id'] }}">Xóa</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" style="padding: 12px 8px; text-align:right; font-weight:700;">
                        Tổng cộng:
                    </td>
                    <td style="padding: 12px 8px; text-align:right; font-weight:700;">
                        {{ number_format($total) }} VND
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>

            <div style="margin-top: 16px; display:flex; gap:12px; flex-wrap:wrap;">
                <button type="submit">Cập nhật giỏ hàng</button>
                <a href="{{ route('products.index') }}">
                    <button type="button">Tiếp tục mua hàng</button>
                </a>
            </div>
        </form>

        <form method="POST" action="{{ route('cart.clear') }}" style="margin-top: 12px;">
            @csrf
            <button type="submit">Xóa toàn bộ giỏ hàng</button>
        </form>
    @endif
@endsection

