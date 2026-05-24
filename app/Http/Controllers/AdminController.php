<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();

        $pendingOrders = Order::where('order_status', 'pending')->count();
        $processingOrders = Order::where('order_status', 'processing')->count();
        $completedOrders = Order::where('order_status', 'completed')->count();

        $totalRevenue = Order::where('order_status', 'completed')
            ->sum('total_price');

        $monthlyOrders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $monthlyRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'pendingOrders',
            'processingOrders',
            'completedOrders',
            'totalRevenue',
            'monthlyOrders',
            'monthlyRevenue',
            'recentOrders'
        ));
    }
}