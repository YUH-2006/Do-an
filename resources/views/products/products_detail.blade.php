@extends('layouts.app')

@section('content')
    <div class="product-detail">
        <a href="{{ route('products.index') }}">← Quay lại danh sách</a>

        <h1>{{ $product->name }}</h1>

        <p><strong>Giá:</strong> {{ number_format($product->price) }} VND</p>

        @if(!empty($product->category))
            <p><strong>Danh mục:</strong> {{ $product->category }}</p>
        @endif

        <div class="product-detail__media">
            @if(!empty($product->image))
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="max-width: 420px; width: 100%; height: auto;">
            @else
                <img src="{{ asset('images/no-image.png') }}" alt="No image" style="max-width: 420px; width: 100%; height: auto;">
            @endif
        </div>

        <div style="margin: 14px 0; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
            <form method="POST" action="{{ route('cart.add', $product->id) }}" style="display:flex; gap:10px; align-items:center;">
                @csrf
                <label>
                    Số lượng:
                    <input type="number" name="qty" value="1" min="1" style="width: 90px; padding: 6px;" />
                </label>
                <button type="submit">Thêm vào giỏ hàng</button>
            </form>

            <a href="{{ route('cart.index') }}">Xem giỏ hàng</a>
        </div>

        @if(!empty($product->description))
            <div class="product-detail__desc">
                <h3>Mô tả</h3>
                <p>{{ $product->description }}</p>
            </div>
        @endif
    </div>
@endsection
