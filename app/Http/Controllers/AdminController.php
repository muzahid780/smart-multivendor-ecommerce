<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // DASHBOARD
   public function dashboard()
{
    $totalProducts = Product::count();
    $totalOrders   = Order::count();
    $totalUsers    = User::count();

    // Revenue (Completed Orders)
    $totalRevenue = Order::where('order_status', 'completed')
        ->sum('total_price');

    // Pending Orders
    $pendingOrders = Order::where('order_status', 'pending')->count();

    // Delivered / Completed Orders
    $deliveredOrders = Order::where('order_status', 'completed')->count();

    // Monthly Orders Chart
    $monthlyOrders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->groupBy('month')
        ->pluck('total', 'month');

    // Monthly Revenue Chart
    $monthlyRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
        ->groupBy('month')
        ->pluck('total', 'month');

    return view('admin.dashboard', compact(
        'totalProducts',
        'totalOrders',
        'totalUsers',
        'totalRevenue',
        'pendingOrders',
        'deliveredOrders',
        'monthlyOrders',
        'monthlyRevenue'
    ));
}

    // USERS LIST
    public function users(Request $request)
    {
        $users = User::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('role'), function ($query) use ($request) {
                $query->where('role', $request->role);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    // DELETE USER
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if (auth()->check() && $user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        if ($user->role === 'admin') {
            return back()->with('error', 'Admin account cannot be deleted.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}