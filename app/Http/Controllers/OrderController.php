<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Cart is empty!');
        }

        return view('frontend.checkout', compact('cart'));
    }
    public function placeOrder(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'shipping_address' => 'required',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please login first!');
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Cart is empty!');
        }

        DB::beginTransaction();

        try {

            //TOTAL CALCULATION
            $total = 0;

            foreach ($cart as $item) {
                $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
            }
            $order = Order::create([
                'user_id' => Auth::id(),
                'phone' => $request->phone,
                'shipping_address' => $request->shipping_address,
                'total_price' => $total,
                'payment_method' => 'cash_on_delivery',
                'payment_status' => 'pending',
                'order_status' => 'pending',
            ]);

            //ORDER ITEMS
            foreach ($cart as $item) {

                $product = Product::find($item['id']);

                if (!$product) continue;

                $qty = $item['quantity'] ?? 1;

                // STOCK CHECK
                if (!isset($product->stock) || $product->stock < $qty) {
                    throw new \Exception("Stock not available for {$product->name}");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'vendor_id' => $product->vendor_id,
                    'quantity' => $qty,
                    'price' => $item['price'] ?? 0,
                ]);

                // REDUCE STOCK
                $product->stock -= $qty;
                $product->save();
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('order.success')
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('frontend.my-orders', compact('orders'));
    }

    //ADMIN ALL ORDERS
    public function index()
    {
        $orders = Order::with('user', 'items.product')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    //STATUS UPDATE
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed'
        ]);

        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $order = Order::findOrFail($id);

        $order->order_status = $request->status;
        $order->save();

        return back()->with('success', 'Order status updated!');
    }

    //ORDER DETAILS
    public function show($id)
    {
        $order = Order::with('items.product', 'user')->findOrFail($id);

        if (Auth::user()->role !== 'admin' && $order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('frontend.order-details', compact('order'));
    }
}