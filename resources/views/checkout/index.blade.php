@extends('layouts.app')

@section('content')
    <h1>Thanh toán</h1>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0" style="padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('checkout.store') }}" style="max-width: 720px;">
        @csrf

        <div style="margin-bottom: 24px;">
            <h2 style="font-size: 18px; margin-bottom: 12px;">Thông tin giao hàng</h2>
            <div style="display: grid; gap: 12px;">
                <div>
                    <label style="display: block; margin-bottom: 4px; font-weight: 600;">Họ tên *</label>
                    <input type="text" name="shipping_name" value="{{ old('shipping_name', $user->name) }}" required
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 4px; font-weight: 600;">Số điện thoại *</label>
                    <input type="text" name="shipping_phone" value="{{ old('shipping_phone', $user->phone ?? '') }}" required
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" placeholder="0912345678">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 4px; font-weight: 600;">Địa chỉ giao hàng *</label>
                    <input type="text" name="shipping_address" value="{{ old('shipping_address', $user->address ?? '') }}" required
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 4px; font-weight: 600;">Ghi chú</label>
                    <textarea name="note" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;"
                        placeholder="Ghi chú cho đơn hàng (tùy chọn)">{{ old('note') }}</textarea>
                </div>
            </div>
        </div>

        <div style="margin-bottom: 24px;">
            <h2 style="font-size: 18px; margin-bottom: 12px;">Phương thức thanh toán</h2>
            <div style="display: flex; flex-direction: column; gap: 10px;">
                @foreach ($paymentMethods as $value => $label)
                    <label style="display: flex; align-items: center; gap: 10px; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; cursor: pointer;">
                        <input type="radio" name="payment_method" value="{{ $value }}" {{ old('payment_method', 'cod') === $value ? 'checked' : '' }}>
                        <span>{{ $label }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div style="margin-bottom: 24px; padding: 16px; background: #f9fafb; border-radius: 10px;">
            <h2 style="font-size: 18px; margin-bottom: 12px;">Đơn hàng của bạn</h2>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <th style="text-align: left; padding: 8px 0;">Sản phẩm</th>
                        <th style="text-align: right; padding: 8px 0;">Đơn giá</th>
                        <th style="text-align: center; padding: 8px 0;">SL</th>
                        <th style="text-align: right; padding: 8px 0;">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px 0;">{{ $item['name'] }}</td>
                            <td style="text-align: right; padding: 10px 0;">{{ number_format($item['price']) }} đ</td>
                            <td style="text-align: center; padding: 10px 0;">{{ $item['qty'] }}</td>
                            <td style="text-align: right; padding: 10px 0;">{{ number_format($item['price'] * $item['qty']) }} đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin-top: 12px; padding-top: 12px; border-top: 2px solid #e5e7eb; font-weight: 700; font-size: 18px; display: flex; justify-content: space-between;">
                <span>Tổng cộng:</span>
                <span>{{ number_format($total) }} VND</span>
            </div>
        </div>

        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            <button type="submit">Xác nhận đặt hàng</button>
            <a href="{{ route('cart.index') }}">
                <button type="button" style="background: #6b7280;">← Quay lại giỏ hàng</button>
            </a>
        </div>
    </form>
@endsection
