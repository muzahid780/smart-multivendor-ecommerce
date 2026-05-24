<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class VendorOrderController extends Controller
{
    public function index()
    {
        $vendorId = auth()->id();

        $orders = Order::whereHas('items.product', function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->with(['items.product', 'user'])
            ->latest()
            ->distinct()
            ->get();

        return view('vendor.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $vendorId = auth()->id();

        $order = Order::whereHas('items.product', function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->with(['items.product', 'user'])
            ->findOrFail($id);

        return view('vendor.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $vendorId = auth()->id();

        $order = Order::whereHas('items.product', function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->findOrFail($id);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Order status updated successfully');
    }
}