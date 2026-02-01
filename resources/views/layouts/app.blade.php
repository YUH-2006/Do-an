<!DOCTYPE html>
<html>
<head>
    <title>Đồ án cơ sở</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<nav class="navbar">
    <div class="nav-left">
        <a href="/products" class="logo">FASTFOOD</a>
        <a href="/products">Sản phẩm</a>
        <a href="#">Giỏ hàng</a>
    </div>

    <form class="nav-search" method="GET" action="/products">
        <input type="text" name="keyword" placeholder="Tìm sản phẩm...">
        <button type="submit">Tìm</button>
    </form>

    <div class="nav-right">
        <span>Xin chào {{ Auth::user()->name ?? 'Guest' }}</span>
        <a href="/logout" class="logout">Logout</a>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>
