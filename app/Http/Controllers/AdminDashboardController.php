<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Thống kê tổng quan
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalUsers = User::count();

        // Doanh thu theo thời gian
        $todayRevenue = Order::where('status', 'completed')
            ->whereDate('created_at', Carbon::today())
            ->sum('total');

        $thisMonthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total');

        // Doanh thu 7 ngày gần nhất (để vẽ biểu đồ)
        $last7Days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $revenue = Order::where('status', 'completed')
                ->whereDate('created_at', $date)
                ->sum('total');
            
            $last7Days->push([
                'date' => $date->format('d/m'),
                'revenue' => $revenue
            ]);
        }

        // Sản phẩm bán chạy nhất
        $topProducts = OrderItem::select('product_id', 'product_name', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id', 'product_name')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        // Đơn hàng mới nhất
        $recentOrders = Order::with('user')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue', 
            'totalOrders', 
            'totalProducts', 
            'totalUsers',
            'todayRevenue',
            'thisMonthRevenue',
            'last7Days',
            'recentOrders',
            'topProducts'
        ));
    }
}
