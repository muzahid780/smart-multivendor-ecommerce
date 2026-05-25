<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Order;

class VendorController extends Controller
{
    public function dashboard()
    {
        $vendorId = auth()->id();

        /*
        |--------------------------------------------------------------------------
        | PRODUCTS
        |--------------------------------------------------------------------------
        */

        $totalProducts = Product::where('vendor_id', $vendorId)->count();

        $approvedProducts = Product::where('vendor_id', $vendorId)
            ->where('approval_status', 'approved')
            ->count();

        // 🔥 FIX: this was missing but blade uses it
        $activeProducts = Product::where('vendor_id', $vendorId)
            ->where('approval_status', 'approved')
            ->count();

        $pendingProducts = Product::where('vendor_id', $vendorId)
            ->where('approval_status', 'pending')
            ->count();

        $rejectedProducts = Product::where('vendor_id', $vendorId)
            ->where('approval_status', 'rejected')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | STOCK
        |--------------------------------------------------------------------------
        */

        $totalStock = Product::where('vendor_id', $vendorId)->sum('stock');

        $outOfStock = Product::where('vendor_id', $vendorId)
            ->where('stock', '<=', 0)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | ORDERS
        |--------------------------------------------------------------------------
        */

        $totalOrders = OrderItem::where('vendor_id', $vendorId)->count();

        $completedOrders = OrderItem::where('vendor_id', $vendorId)
            ->whereHas('order', function ($q) {
                $q->where('order_status', 'completed');
            })
            ->count();

        $pendingOrders = OrderItem::where('vendor_id', $vendorId)
            ->whereHas('order', function ($q) {
                $q->where('order_status', 'pending');
            })
            ->count();

        /*
        |--------------------------------------------------------------------------
        | EARNINGS
        |--------------------------------------------------------------------------
        */

        $totalEarnings = auth()->user()->earnings ?? 0;

        /*
        |--------------------------------------------------------------------------
        | RECENT DATA
        |--------------------------------------------------------------------------
        */

        $recentProducts = Product::where('vendor_id', $vendorId)
            ->latest()
            ->limit(5)
            ->get();

        $recentOrders = OrderItem::with(['order', 'product'])
            ->where('vendor_id', $vendorId)
            ->latest()
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('vendor.dashboard', [
            'totalProducts'    => $totalProducts,
            'approvedProducts' => $approvedProducts,
            'activeProducts'   => $activeProducts, // ✅ FIXED HERE

            'pendingProducts'  => $pendingProducts,
            'rejectedProducts' => $rejectedProducts,

            'totalStock'       => $totalStock,
            'outOfStock'       => $outOfStock,

            'totalOrders'      => $totalOrders,
            'completedOrders'  => $completedOrders,
            'pendingOrders'    => $pendingOrders,

            'totalEarnings'    => $totalEarnings,

            'recentProducts'   => $recentProducts,
            'recentOrders'     => $recentOrders,
        ]);
    }
}