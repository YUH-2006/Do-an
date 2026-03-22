@extends('layouts.app')

@section('content')
    <div style="max-width: 640px; margin: 20px auto; padding: 24px; background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
        <div style="text-align: center; margin-bottom: 24px;">
            <div style="width: 64px; height: 64px; margin: 0 auto 16px; background: #10b981; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: bold;">✓</div>
            <h1 style="margin: 0 0 8px; color: #10b981;">Đặt hàng thành công!</h1>
            <p style="margin: 0; color: #6b7280;">Mã đơn hàng: <strong>#{{ $order->id }}</strong></p>
        </div>

        <div style="padding: 16px; background: #f9fafb; border-radius: 10px; margin-bottom: 20px;">
            <p style="margin: 0 0 8px;"><strong>Người nhận:</strong> {{ $order->shipping_name }}</p>
            <p style="margin: 0 0 8px;"><strong>Điện thoại:</strong> {{ $order->shipping_phone }}</p>
            <p style="margin: 0 0 8px;"><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
            <p style="margin: 0;"><strong>Thanh toán:</strong> {{ $order->payment_method === 'cod' ? 'Tiền mặt khi nhận hàng' : 'Chuyển khoản ngân hàng' }}</p>
        </div>

        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #e5e7eb;">
                    <th style="text-align: left; padding: 10px 0;">Sản phẩm</th>
                    <th style="text-align: right; padding: 10px 0;">Đơn giá</th>
                    <th style="text-align: center; padding: 10px 0;">SL</th>
                    <th style="text-align: right; padding: 10px 0;">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px 0;">{{ $item->product_name }}</td>
                        <td style="text-align: right; padding: 10px 0;">{{ number_format($item->price) }} đ</td>
                        <td style="text-align: center; padding: 10px 0;">{{ $item->qty }}</td>
                        <td style="text-align: right; padding: 10px 0;">{{ number_format($item->price * $item->qty) }} đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 16px; padding-top: 16px; border-top: 2px solid #e5e7eb; font-weight: 700; font-size: 18px; display: flex; justify-content: space-between;">
            <span>Tổng cộng:</span>
            <span>{{ number_format($order->total) }} VND</span>
        </div>

        @if ($order->payment_method === 'bank')
            <div style="margin-top: 20px; padding: 16px; background: #fef3c7; border-radius: 10px; font-size: 14px;">
                <strong>Lưu ý:</strong> Vui lòng chuyển khoản {{ number_format($order->total) }} VND tới tài khoản ngân hàng của cửa hàng. Nội dung chuyển khoản: <code>DON {{ $order->id }}</code>
            </div>
        @endif

        <div style="margin-top: 24px; text-align: center; display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('orders.show', $order) }}">
                <button type="button" style="background: #3b82f6;">Xem đơn hàng</button>
            </a>
            <a href="{{ route('products.index') }}">
                <button type="button">Tiếp tục mua hàng</button>
            </a>
        </div>
    </div>
@endsection
