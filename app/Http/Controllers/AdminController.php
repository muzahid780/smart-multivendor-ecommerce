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
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();

        // Revenue (only completed orders)
        $totalRevenue = Order::where('status', 'completed')
            ->sum('total_price');

        // Recent orders
        $recentOrders = Order::with('product')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalRevenue',
            'recentOrders'
        ));
    }
}