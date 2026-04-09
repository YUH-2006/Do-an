@extends('layouts.admin')

@section('content')
<div class="container mt-4" style="max-width: 880px;">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="m-0">Thêm sản phẩm</h2>
        <a href="/admin/products" class="btn btn-outline-secondary">← Quay lại</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-semibold mb-1">Vui lòng kiểm tra lại:</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/admin/products" enctype="multipart/form-data" class="card p-3">
        @csrf

        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Giá (VND)</label>
                <input type="number" name="price" class="form-control" value="{{ old('price') }}" min="0" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Danh mục</label>
                <input type="text" name="category" class="form-control" value="{{ old('category') }}" placeholder="Ví dụ: Burger / Pizza / Đồ Uống">
            </div>

            <div class="col-md-6">
                <label class="form-label">Ảnh sản phẩm (tùy chọn)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <div class="col-12">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-control" rows="5" placeholder="Mô tả ngắn...">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
            <a href="/admin/products" class="btn btn-secondary">Hủy</a>
        </div>
    </form>

</div>
@endsection

