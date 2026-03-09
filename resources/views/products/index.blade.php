<!DOCTYPE html>
<html>
<head>
    <title>Đồ án cơ sở</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@extends('layouts.app')

@section('content')
<h1>Danh sách sản phẩm</h1>

<div class="product-list">
@foreach($products as $product)
    <div class="product-card">
        <h3>{{ $product->name }}</h3>
        <p>Giá: {{ number_format($product->price) }} VND</p>

        @if($product->image)
        <img src="{{ asset('images/products/burger.jpg') }}" width="150">
        @endif

        <br>
        <a href="/products/{{ $product->id }}">
            <button>Xem chi tiết</button>
        </a>
    </div>
@endforeach
</div>
@endsection


</div>

</body>
</html>
