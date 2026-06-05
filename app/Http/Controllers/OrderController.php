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
    //CHECKOUT
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/cart')
                ->with('error', 'Cart is empty!');
        }
        return view('frontend.checkout', compact('cart'));
    }

    //PLACE ORDER
    public function placeOrder(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:1000',
        ]);
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please login first!');
        }
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()
                ->with('error', 'Cart is empty!');
        }
        DB::beginTransaction();

        try {
            $total = 0;
            foreach ($cart as $item) {
                $price = $item['price'] ?? 0;
                $qty   = $item['quantity'] ?? 1;
                $total += ($price * $qty);
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'phone' => $request->phone,
                'shipping_address' => $request->shipping_address,
                'total_price' => $total,
                'admin_commission' => 0,
                'payment_method' => 'cash_on_delivery',
                'payment_status' => 'pending',
                'order_status' => 'pending',
            ]);

            foreach ($cart as $item) {
                $product = Product::find($item['id']);
                if (!$product) {
                    continue;
                }
                $qty = $item['quantity'] ?? 1;

                //STOCK CHECK
                if ($product->stock < $qty) {
                    throw new \Exception(
                        "Stock not available for {$product->name}"
                    );
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'vendor_id' => $product->vendor_id,
                    'quantity' => $qty,
                    'price' => $item['price'] ?? 0,
                ]);
                $product->decrement('stock', $qty);
            }
            DB::commit();
            session()->forget('cart');
            return redirect()->route('order.success')
                ->with('success', 'Order placed successfully!');
        }

        catch (\Exception $e) {
            DB::rollBack();
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    //USER ORDERS
    public function myOrders()
    {
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('frontend.my-orders', compact('orders'));
    }

    //ADMIN ALL ORDERS
    public function index()
    {
        $orders = Order::with([
                'user',
                'items.product',
            ])
            ->latest()
            ->get();
        return view('admin.orders.index', compact('orders'));
    }

    //UPDATE ORDER STATUS
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        $order = Order::with([
                'items.product.vendor'
            ])
            ->findOrFail($id);

        $order->update([
            'order_status' => $request->status
        ]);
        if (
            $request->status === 'completed'
            && $order->admin_commission == 0
        ) {
            $totalCommission = 0;
            foreach ($order->items as $item) {
                if (!$item->product) {
                    continue;
                }
                $subtotal = $item->price * $item->quantity;
                $commission = $subtotal * 0.10;
                $totalCommission += $commission;
                
                 //VENDOR EARNINGS
                $vendor = $item->product->vendor;
                if ($vendor) {
                    $vendor->increment(
                        'earnings',
                        $subtotal - $commission
                    );
                }
            }
            $order->update([
                'admin_commission' => $totalCommission
            ]);
        }
        return back()
            ->with('success', 'Order status updated successfully!');
    }

    //ORDER DETAILS
    public function show($id)
    {
        $order = Order::with([
                'items.product',
                'user'
            ])
            ->findOrFail($id);
        if (
            Auth::user()->role !== 'admin'
            &&
            $order->user_id !== Auth::id()
        ) {
            abort(403);
        }
        return view('frontend.order-details', compact('order'));
    }

    //ADMIN ORDER DETAILS
    public function showAdmin($id)
    {
        $order = Order::with([
                'items.product.vendor',
                'user'
            ])
            ->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
}