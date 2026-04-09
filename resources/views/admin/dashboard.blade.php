@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Thống kê doanh thu</h2>
        <div class="text-muted">{{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <!-- Thống kê tổng quan -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-currency-dollar text-primary" viewBox="0 0 16 16">
                            <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.444l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-muted small">Tổng doanh thu</div>
                        <div class="h4 fw-bold mb-0">{{ number_format($totalRevenue) }}đ</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart-check text-success" viewBox="0 0 16 16">
                            <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-muted small">Tổng đơn hàng</div>
                        <div class="h4 fw-bold mb-0">{{ number_format($totalOrders) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 p-3 rounded-3 me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-box-seam text-info" viewBox="0 0 16 16">
                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.747l-5.051 2.02v3.307l3.14-1.256c.545-.218.81-.812.81-1.406V4.286zm-6.051 5.34l5.051-2.02V4.286L8.949 6.307v3.319zm-1 0V6.307L2.897 4.286v4.148c0 .594.265 1.188.81 1.406l3.14 1.256V9.627zm0-3.32L2.846 4.287 1 3.55v4.887c0 .594.265 1.188.81 1.406l3.14 1.256V6.307z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-muted small">Tổng sản phẩm</div>
                        <div class="h4 fw-bold mb-0">{{ number_format($totalProducts) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-people text-warning" viewBox="0 0 16 16">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-muted small">Khách hàng</div>
                        <div class="h4 fw-bold mb-0">{{ number_format($totalUsers) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Biểu đồ doanh thu -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4">
                <h5 class="fw-bold mb-4">Doanh thu 7 ngày gần nhất</h5>
                <canvas id="revenueChart" height="100"></canvas>
            </div>
        </div>
        
        <!-- Doanh thu chi tiết -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4">
                <h5 class="fw-bold mb-4">Doanh thu theo mốc</h5>
                <div class="mb-4">
                    <div class="text-muted small">Hôm nay</div>
                    <div class="h3 fw-bold text-primary">{{ number_format($todayRevenue) }}đ</div>
                </div>
                <div class="mb-0">
                    <div class="text-muted small">Tháng này</div>
                    <div class="h3 fw-bold text-success">{{ number_format($thisMonthRevenue) }}đ</div>
                </div>
            </div>

            <!-- Sản phẩm bán chạy -->
            <div class="card border-0 shadow-sm p-4 mt-4">
                <h5 class="fw-bold mb-4">Sản phẩm bán chạy</h5>
                @foreach($topProducts as $item)
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="text-truncate me-2" style="max-width: 150px;">
                        <span class="fw-bold text-dark">{{ $item->product_name }}</span>
                    </div>
                    <span class="badge bg-primary rounded-pill">{{ $item->total_qty }} lượt bán</span>
                </div>
                @endforeach
                @if($topProducts->isEmpty())
                <div class="text-center text-muted py-3 small">Chưa có dữ liệu bán hàng</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Đơn hàng mới nhất -->
    <div class="card border-0 shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">Đơn hàng mới nhất</h5>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">Xem tất cả</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Mã ĐH</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                    <tr>
                        <td class="fw-bold">#{{ $order->id }}</td>
                        <td>
                            <div>{{ $order->shipping_name }}</div>
                            <div class="small text-muted">{{ $order->shipping_phone }}</div>
                        </td>
                        <td>{{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                        <td class="fw-bold text-primary">{{ number_format($order->total) }}đ</td>
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
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-light">Chi tiết</a>
                        </td>
                    </tr>
                    @endforeach
                    @if($recentOrders->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Chưa có đơn hàng nào</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Data for Chart -->
<div id="revenue-data" 
     data-labels="{{ json_encode($last7Days->pluck('date')) }}" 
     data-values="{{ json_encode($last7Days->pluck('revenue')) }}" 
     style="display: none;">
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('revenueChart');
        const dataEl = document.getElementById('revenue-data');
        const labels = JSON.parse(dataEl.getAttribute('data-labels'));
        const values = JSON.parse(dataEl.getAttribute('data-values'));
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu (đ)',
                    data: values,
                    borderWidth: 3,
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString() + 'đ';
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endsection
