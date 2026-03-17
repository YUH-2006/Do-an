@extends('layouts.app')

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
    <h1 style="margin:0;">Danh sách sản phẩm</h1>
    <a href="{{ route('cart.index') }}">
        <button type="button">Xem giỏ hàng</button>
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success" style="margin: 10px 0 14px;">
        {{ session('success') }}
    </div>
@endif

<div class="product-list">
@foreach($products as $product)
    <div class="product-card">
        <h3>{{ $product->name }}</h3>
        <p>Giá: {{ number_format($product->price) }} VND</p>

        @if($product->image)
            <img src="{{ asset($product->image) }}" width="150" alt="{{ $product->name }}">
        @endif

        <br>
        <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
            <form method="POST" action="{{ route('cart.add', $product->id) }}" style="display:inline-flex;">
                @csrf
                <input type="hidden" name="qty" value="1" />
                <button type="submit">Thêm vào giỏ</button>
            </form>

            <a href="{{ route('products.show', $product->id) }}">
                <button type="button">Xem chi tiết</button>
            </a>
        </div>
    </div>
@endforeach
</div>
@endsection
