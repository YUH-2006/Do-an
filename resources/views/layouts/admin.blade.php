<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" style="width:220px; min-height:100vh;">
        <h4>ADMIN</h4>
        <a href="/admin/admins" class="text-white d-block mt-2">Quản lý Admin</a>
        <a href="/products" class="text-white d-block mt-2">Sản phẩm</a>
        <a href="/logout" class="text-white d-block mt-2">Đăng xuất</a>
    </div>

    <!-- Content -->
    <div class="flex-fill p-4">
        @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
