@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="m-0">Quản lý Sản phẩm</h2>
        <a href="/admin/products/create" class="btn btn-primary">+ Thêm sản phẩm</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width:80px;">ID</th>
                <th style="width:110px;">Ảnh</th>
                <th>Tên</th>
                <th style="width:160px;">Danh mục</th>
                <th style="width:140px;">Giá</th>
                <th style="width:140px;">Hành động</th>
            </tr>
        </thead>

        <tbody>
        @forelse($products as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>
                    @if(!empty($p->image))
                        <img src="{{ asset($p->image) }}" alt="{{ $p->name }}" style="width:90px; height:60px; object-fit:cover; border-radius:6px;">
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
                <td>
                    <div class="fw-semibold">{{ $p->name }}</div>
                    @if(!empty($p->description))
                        <div class="text-muted" style="max-width:520px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $p->description }}
                        </div>
                    @endif
                </td>
                <td>{{ $p->category ?? '—' }}</td>
                <td>{{ number_format($p->price) }} VND</td>
                <td>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="/admin/products/{{ $p->id }}/edit" class="btn btn-sm btn-warning">Sửa</a>
                        <form method="POST" action="/admin/products/{{ $p->id }}/delete" style="display:inline-flex;"
                              onsubmit="return confirm('Xóa sản phẩm này?')">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted">Chưa có sản phẩm.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>
@endsection

