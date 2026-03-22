@extends('layouts.app')

@section('content')
    <div style="max-width: 720px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px;">
            <h1>Đơn hàng #{{ $order->id }}</h1>
            <a href="{{ route('orders.index') }}" style="text-decoration: none; padding: 8px 12px; border: 1px solid #ddd; border-radius: 8px;">← Danh sách đơn hàng</a>
        </div>

        @php
            $badgeColors = [
                'pending' => '#f59e0b',
                'confirmed' => '#3b82f6',
                'shipping' => '#8b5cf6',
                'completed' => '#10b981',
                'cancelled' => '#6b7280',
            ];
            $color = $badgeColors[$order->status] ?? '#6b7280';
        @endphp

        <div style="margin-bottom: 20px; padding: 16px; background: #f9fafb; border-radius: 10px;">
            <p style="margin: 0 0 8px;"><strong>Trạng thái:</strong>
                <span style="display: inline-block; padding: 4px 12px; border-radius: 999px; font-size: 14px; font-weight: 700; background: {{ $color }}; color: #fff;">
                    {{ $order->getStatusLabel() }}
                </span>
            </p>
            <p style="margin: 0 0 8px;"><strong>Ngày đặt:</strong> {{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : '-' }}</p>
            <p style="margin: 0 0 8px;"><strong>Người nhận:</strong> {{ $order->shipping_name }}</p>
            <p style="margin: 0 0 8px;"><strong>Điện thoại:</strong> {{ $order->shipping_phone }}</p>
            <p style="margin: 0 0 8px;"><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
            <p style="margin: 0;"><strong>Thanh toán:</strong> {{ $order->payment_method === 'cod' ? 'Tiền mặt khi nhận hàng' : 'Chuyển khoản ngân hàng' }}</p>
        </div>

        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #e5e7eb;">
                    <th style="text-align: left; padding: 12px 0;">Sản phẩm</th>
                    <th style="text-align: right; padding: 12px 0;">Đơn giá</th>
                    <th style="text-align: center; padding: 12px 0;">SL</th>
                    <th style="text-align: right; padding: 12px 0;">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px 0;">{{ $item->product_name }}</td>
                        <td style="text-align: right; padding: 12px 0;">{{ number_format($item->price) }} đ</td>
                        <td style="text-align: center; padding: 12px 0;">{{ $item->qty }}</td>
                        <td style="text-align: right; padding: 12px 0;">{{ number_format($item->price * $item->qty) }} đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 16px; padding-top: 16px; border-top: 2px solid #e5e7eb; font-weight: 700; font-size: 18px; display: flex; justify-content: space-between;">
            <span>Tổng cộng:</span>
            <span>{{ number_format($order->total) }} VND</span>
        </div>
    </div>
@endsection
