<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-box">
    <h2>Đăng ký</h2>

    <form method="POST" action="/register">
        @csrf
        <input type="text" name="name" placeholder="Họ tên">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Mật khẩu">
        <button type="submit">Đăng ký</button>
    </form>

    <a href="/login">Đã có tài khoản? Đăng nhập</a>
</div>

</body>
</html>
