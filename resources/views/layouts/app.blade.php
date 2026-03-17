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
            <span class="jl-nav__brand-mark" aria-hidden="true" style="padding:0; overflow:hidden;">
                <img
                    src="{{ asset('images/drawing-some-food-icons-v0-yy4yiof2mly81.webp') }}"
                    alt=""
                    style="width:38px; height:38px; object-fit:cover; display:block;"
                />
            </span>
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
            @php
                $cart = session('cart', []);
                $cartItems = array_values($cart);
                $cartCount = collect($cart)->sum('qty');
                $cartTotal = collect($cartItems)->reduce(function ($carry, $item) {
                    return $carry + (($item['price'] ?? 0) * ($item['qty'] ?? 0));
                }, 0);
            @endphp

            <div class="jl-cart" data-cart>
                <button type="button" class="jl-cart__btn jl-nav__link" aria-haspopup="dialog" aria-expanded="false" data-cart-btn>
                    <span class="jl-cart__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 6h15l-1.5 9h-12z"></path>
                            <path d="M6 6L5 3H2"></path>
                            <circle cx="9" cy="20" r="1.5"></circle>
                            <circle cx="18" cy="20" r="1.5"></circle>
                        </svg>
                    </span>
                    <span class="jl-cart__label">Giỏ hàng</span>
                    @if($cartCount > 0)
                        <span class="jl-cart__badge" aria-label="{{ $cartCount }} sản phẩm trong giỏ">{{ $cartCount }}</span>
                    @endif
                </button>

                <div class="jl-cart__overlay" data-cart-overlay></div>
                <aside class="jl-cart__drawer" role="dialog" aria-modal="true" aria-label="Đơn hàng của bạn" data-cart-drawer>
                    <div class="jl-cart__drawer-head">
                        <div class="jl-cart__drawer-title">ĐƠN HÀNG CỦA BẠN</div>
                        <button type="button" class="jl-cart__close" aria-label="Đóng" data-cart-close>×</button>
                    </div>

                    <div class="jl-cart__drawer-body">
                        @if($cartCount === 0)
                            <div class="jl-cart__drawer-empty">
                                Bạn không có sản phẩm nào trong giỏ hàng của bạn.
                            </div>
                        @else
                            <div class="jl-cart__drawer-items">
                                @foreach($cartItems as $item)
                                    <div class="jl-cart__drawer-item">
                                        @if(!empty($item['image']))
                                            <img class="jl-cart__drawer-img" src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                                        @else
                                            <div class="jl-cart__drawer-img jl-cart__drawer-img--ph" aria-hidden="true"></div>
                                        @endif
                                        <div class="jl-cart__drawer-info">
                                            <div class="jl-cart__drawer-name">{{ $item['name'] }}</div>
                                            <div class="jl-cart__drawer-sub">SL: {{ $item['qty'] }}</div>
                                        </div>
                                        <div class="jl-cart__drawer-price">
                                            {{ number_format(($item['price'] ?? 0) * ($item['qty'] ?? 0)) }} VND
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="jl-cart__drawer-foot">
                        <div class="jl-cart__drawer-total">
                            <span>Tổng</span>
                            <b>{{ number_format($cartTotal) }} VND</b>
                        </div>
                        <div class="jl-cart__drawer-actions">
                            <a href="{{ route('cart.index') }}"><button type="button">Xem giỏ hàng</button></a>
                            <a href="{{ route('cart.index') }}"><button type="button">Thanh toán</button></a>
                        </div>
                    </div>
                </aside>
            </div>
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

<script>
    (function () {
        const root = document.querySelector('[data-cart]');
        if (!root) return;

        const btn = root.querySelector('[data-cart-btn]');
        const overlay = root.querySelector('[data-cart-overlay]');
        const drawer = root.querySelector('[data-cart-drawer]');
        const closeBtn = root.querySelector('[data-cart-close]');

        function close() {
            root.classList.remove('is-open');
            if (btn) btn.setAttribute('aria-expanded', 'false');
        }

        function toggle() {
            const isOpen = root.classList.toggle('is-open');
            if (btn) btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        }

        btn && btn.addEventListener('click', function (e) {
            e.preventDefault();
            toggle();
        });

        overlay && overlay.addEventListener('click', function () {
            close();
        });

        closeBtn && closeBtn.addEventListener('click', function (e) {
            e.preventDefault();
            close();
        });

        document.addEventListener('click', function (e) {
            if (!root.contains(e.target)) close();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') close();
        });

        drawer && drawer.addEventListener('click', function (e) {
            // allow clicking inside drawer
            e.stopPropagation();
        });
    })();
</script>

</body>
</html>
