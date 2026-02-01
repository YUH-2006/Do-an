<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<h1>Danh sách sản phẩm</h1>

@if(count($products) == 0)
    <p>Chưa có sản phẩm nào.</p>
@else
<div class="product-list">
    @foreach($products as $product)
        <div class="product-card">
            <h3>{{ $product->name }}</h3>
            <p>Giá: {{ number_format($product->price) }} VND</p>

            @if(!empty($product->image))
                <img src="{{ asset('images/products/' . $product->image) }}" width="150">
            @else
                <img src="{{ asset('images/no-image.png') }}" width="150">
            @endif

            <a href="{{ route('products.show', $product->id) }}">
                <button>Xem chi tiết</button>
            </a>
        </div>
    @endforeach
</div>
@endif

</body>
</html>
