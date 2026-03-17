<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

<div class="d-flex admin-wrapper">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar__brand">ADMIN</div>

        <nav class="sidebar__nav">
            <a href="/admin/admins"
               class="sidebar__link {{ request()->is('admin/admins*') ? 'is-active' : '' }}">
                Quản lý Admin
            </a>
            <a href="/admin/products"
               class="sidebar__link {{ request()->is('admin/products*') ? 'is-active' : '' }}">
                Quản lý Sản phẩm
            </a>

            <div class="sidebar__divider"></div>

            <a href="/logout" class="sidebar__link sidebar__link--danger">
                Đăng xuất
            </a>
        </nav>
    </aside>

    <!-- Content -->
    <main class="main-content">
        @yield('content')
    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
