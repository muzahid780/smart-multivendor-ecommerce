<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class VendorController extends Controller
{
    public function dashboard()
    {
        $vendorId = auth()->id();

        $totalProducts = Product::where('vendor_id', $vendorId)->count();

        $totalStock = Product::where('vendor_id', $vendorId)->sum('stock');

        $activeProducts = Product::where('vendor_id', $vendorId)
            ->where('status', 1)
            ->count();

        $outOfStock = Product::where('vendor_id', $vendorId)
            ->where('stock', '<=', 0)
            ->count();

        return view('vendor.dashboard', compact(
            'totalProducts',
            'totalStock',
            'activeProducts',
            'outOfStock'
        ));
    }
}