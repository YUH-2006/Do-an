@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Quản lý Đơn hàng</h2>
    </div>

    <div class="card border-0 shadow-sm p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Mã ĐH</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Phương thức</th>
                        <th>Trạng thái</th>
                        <th class="text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="fw-bold">#{{ $order->id }}</td>
                        <td>
                            <div>{{ $order->shipping_name }}</div>
                            <div class="small text-muted">{{ $order->shipping_phone }}</div>
                        </td>
                        <td>{{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                        <td class="fw-bold text-primary">{{ number_format($order->total) }}đ</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-warning',
                                    'confirmed' => 'bg-info',
                                    'shipping' => 'bg-primary',
                                    'completed' => 'bg-success',
                                    'cancelled' => 'bg-danger',
                                ];
                                $class = $statusClasses[$order->status] ?? 'bg-secondary';
                            @endphp
                            <span class="badge {{ $class }} bg-opacity-10 {{ str_replace('bg-', 'text-', $class) }} px-3 py-2">
                                {{ $order->getStatusLabel() }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">Chi tiết</a>
                        </td>
                    </tr>
                    @endforeach
                    @if($orders->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">Không tìm thấy đơn hàng nào</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
