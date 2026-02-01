<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<div class="admin-wrapper">
    <div class="sidebar">
        <h2>ADMIN</h2>
        <a href="/admin/admins">Quản lý Admin</a>
        <a href="/products">Sản phẩm</a>
        <a href="/logout">Đăng xuất</a>
    </div>

    <div class="main-content">
        @yield('content')
    </div>
</div>

</body>
</html>
