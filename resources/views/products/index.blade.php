@extends('layouts.app')

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
    <h1 style="margin:0;">Danh sách sản phẩm</h1>
    <a href="{{ route('cart.index') }}">
        <button type="button">Xem giỏ hàng</button>
    </a>
</div>

<form method="GET" action="{{ route('products.index') }}" id="searchForm" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap; margin: 14px 0;">
    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Tìm theo tên sản phẩm..." style="padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; min-width: 200px;">
    <select name="category" style="padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px;" onchange="document.getElementById('searchForm').submit();">
        <option value="">Tất cả loại</option>
        @foreach($categories ?? [] as $cat)
            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
        @endforeach
    </select>
    <button type="submit">Tìm kiếm</button>
</form>

@if (session('success'))
    <div class="alert alert-success" style="margin: 10px 0 14px;">
        {{ session('success') }}
    </div>
@endif

@if(count($products) === 0)
    <p style="margin: 14px 0;">Không tìm thấy sản phẩm nào.</p>
@else
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
@endif
@endsection
