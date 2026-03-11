<!DOCTYPE html>
<html>
<head>
    <title>Đồ án cơ sở</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<nav class="jl-nav">
    <div class="jl-nav__inner">
        <a href="/products" class="jl-nav__brand" aria-label="FASTFOOD">
            <span class="jl-nav__brand-mark">F</span>
            <span class="jl-nav__brand-text">FASTFOOD</span>
        </a>

        <div class="jl-nav__menu" aria-label="Menu chính">
            <a class="jl-nav__link jl-nav__link--active" href="/products">TRANG CHỦ</a>
            <a class="jl-nav__link" href="/products">THỰC ĐƠN</a>
            <a class="jl-nav__link" href="#">KHUYẾN MÃI</a>
            <a class="jl-nav__link" href="#">TIN TỨC</a>
            <a class="jl-nav__link" href="#">CỬA HÀNG</a>
            <a class="jl-nav__link" href="#">LIÊN HỆ</a>
            <a class="jl-nav__link" href="#">TUYỂN DỤNG</a>
        </div>

        <div class="jl-nav__right">
            <form class="jl-nav__search" method="GET" action="/products" aria-label="Tìm sản phẩm">
                <input type="text" name="keyword" placeholder="Tìm sản phẩm..." />
                <button type="submit">Tìm</button>
            </form>

            <div class="jl-nav__user">
                <span class="jl-nav__hello">Xin chào {{ Auth::user()->name ?? 'Guest' }}</span>
                <a href="/logout" class="jl-nav__logout">Logout</a>
            </div>
        </div>
    </div>
</nav>

<main class="container">
    @yield('content')
</main>

@include('partials.footer')

</body>
</html>
