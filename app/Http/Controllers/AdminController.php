<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ================= DASHBOARD =================
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalOrders   = Order::count();
        $totalUsers    = User::count();

        $totalRevenue = Order::where('order_status', 'completed')
            ->sum('total_price');

        $monthlyOrders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $monthlyRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalUsers',
            'totalRevenue',
            'monthlyOrders',
            'monthlyRevenue'
        ));
    }

    // ================= USERS LIST =================
    public function users(Request $request)
    {
        $users = User::query()

            // search
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })

            // role filter (future use)
            ->when($request->filled('role'), function ($query) use ($request) {
                $query->where('role', $request->role);
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    // ================= DELETE USER =================
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // prevent self delete
        if (auth()->check() && $user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        // protect admin account
        if ($user->role === 'admin') {
            return back()->with('error', 'Admin account cannot be deleted.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    // ================= VENDOR APPROVAL SYSTEM =================

    public function pendingProducts()
    {
        $products = Product::where('approval_status', 'pending')
            ->latest()
            ->paginate(10);

        return view('admin.products.pending', compact('products'));
    }

    public function approveProduct($id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'approval_status' => 'approved',
        ]);

        return back()->with('success', 'Product approved successfully.');
    }

    public function rejectProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'approval_status' => 'rejected',
            'admin_note' => $request->admin_note ?? null,
        ]);

        return back()->with('success', 'Product rejected successfully.');
    }
}