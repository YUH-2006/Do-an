@extends('layouts.app')

@section('content')
    <h1>Đơn hàng của tôi</h1>

    @if (count($orders) === 0)
        <p>Bạn chưa có đơn hàng nào.</p>
        <a href="{{ route('products.index') }}">
            <button type="button">Mua sắm ngay</button>
        </a>
    @else
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #e5e7eb;">
                        <th style="text-align: left; padding: 12px 10px;">Mã đơn</th>
                        <th style="text-align: right; padding: 12px 10px;">Tổng tiền</th>
                        <th style="text-align: center; padding: 12px 10px;">Trạng thái</th>
                        <th style="text-align: left; padding: 12px 10px;">Ngày đặt</th>
                        <th style="padding: 12px 10px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 12px 10px;">#{{ $order->id }}</td>
                            <td style="padding: 12px 10px; text-align: right;">{{ number_format($order->total) }} VND</td>
                            <td style="padding: 12px 10px; text-align: center;">
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
                                <span style="display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 700; background: {{ $color }}; color: #fff;">
                                    {{ $order->getStatusLabel() }}
                                </span>
                            </td>
                            <td style="padding: 12px 10px;">{{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : '-' }}</td>
                            <td style="padding: 12px 10px;">
                                <a href="{{ route('orders.show', $order) }}" style="text-decoration: none; color: #ff5722; font-weight: 700;">Chi tiết</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
