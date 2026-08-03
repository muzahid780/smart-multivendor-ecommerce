<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\OrderCompletedNotification;

class OrderController extends Controller
{
    // CHECKOUT PAGE
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.page')
                ->with('error', 'Your cart is empty!');
        }

        return view('frontend.checkout', compact('cart'));
    }

    // PLACE ORDER
    public function placeOrder(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:1000',
            'payment_method' => 'required|in:cash_on_delivery,sslcommerz',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.page')
                ->with('error', 'Your cart is empty!');
        }

        DB::beginTransaction();

        try {

            $total = 0;

            foreach ($cart as $item) {
                $total += ($item['price'] * $item['quantity']);
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'phone' => $request->phone,
                'shipping_address' => $request->shipping_address,
                'total_price' => $total,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'order_status' => 'pending',
            ]);

            foreach ($cart as $item) {

                $product = Product::findOrFail($item['id']);

                $qty = $item['quantity'];

                if ($product->stock < $qty) {
                    throw new \Exception(
                        "{$product->name} does not have enough stock."
                    );
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $item['price'],
                ]);

                $product->decrement('stock', $qty);
            }

            DB::commit();

            session()->forget('cart');

            // CASH ON DELIVERY
            if ($request->payment_method === 'cash_on_delivery') {

                return redirect()
                    ->route('order.success')
                    ->with('success', 'Order placed successfully!');
            }

            // SSLCOMMERZ
            return redirect()
                ->route('order.show', $order->id)
                ->with('success', 'Order created successfully. Complete payment to confirm your order.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    // USER ORDERS
    public function myOrders()
    {
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('frontend.my-orders', compact('orders'));
    }

    // ADMIN ORDERS LIST
    public function index()
    {
        $orders = Order::with([
                'user',
                'items.product'
            ])
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    // USER ORDER DETAILS
    public function show($id)
    {
        $order = Order::with([
                'items.product',
                'user'
            ])
            ->findOrFail($id);

        if (
            Auth::user()->role !== 'admin' &&
            $order->user_id !== Auth::id()
        ) {
            abort(403);
        }

        return view('frontend.order-details', compact('order'));
    }

    // ADMIN ORDER DETAILS
    public function showAdmin($id)
    {
        $order = Order::with([
                'items.product',
                'user'
            ])
            ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }
    // ADMIN UPDATE ORDER STATUS
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,processing,completed',
    ]);

    $order = Order::with('user')->findOrFail($id);

    $order->order_status = $request->status;

    if ($request->status === 'completed') {
        $order->payment_status = 'paid';

        // 🔔 SEND NOTIFICATION TO USER
        $order->user->notify(new OrderCompletedNotification($order));
    }

    $order->save();

    return redirect()
        ->route('admin.orders.show', $order->id)
        ->with('success', 'Order status updated successfully!');
}
}