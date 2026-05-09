<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Orders List
    public function index()
    {
        $orders = Order::with('product')->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    // Create Form
    public function create()
    {
        $products = Product::all();

        return view('admin.orders.create', compact('products'));
    }

    // Store Order
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $total = $product->price * $request->quantity;

        Order::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $total,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully!');
    }
    public function updateStatus($id)
{
    $order = \App\Models\Order::findOrFail($id);

    if ($order->status == 'pending') {
        $order->status = 'completed';
    } else {
        $order->status = 'pending';
    }

    $order->save();

    return redirect()->back()->with('success', 'Order status updated!');
}
use Barryvdh\DomPDF\Facade\Pdf;

public function exportPdf()
{
    $orders = \App\Models\Order::with('product')->get();

    $pdf = Pdf::loadView('admin.orders.pdf', compact('orders'));

    return $pdf->download('orders-report.pdf');
}
}