<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class SSLCommerzController extends Controller
{
    private string $store_id;
    private string $store_password;
    private string $base_url;

    public function __construct()
    {
        $this->store_id = env('SSLCZ_STORE_ID');
        $this->store_password = env('SSLCZ_STORE_PASSWORD');

        $this->base_url = env('SSLCZ_MODE') === 'live'
            ? "https://securepay.sslcommerz.com"
            : "https://sandbox.sslcommerz.com";
    }

    public function pay(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id'
        ]);

        $order = Order::with('items')
            ->where('id', $request->order_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($order->payment_status === 'paid') {
            return back()->with('error', 'Order already paid!');
        }

        if (!$this->store_id || !$this->store_password) {
            return back()->with('error', 'SSLCommerz credentials missing in .env');
        }

        $tran_id = uniqid('TRX_');

        $order->update([
            'transaction_id' => $tran_id
        ]);

        $post_data = [
            'store_id' => $this->store_id,
            'store_passwd' => $this->store_password,
            'total_amount' => (float) $order->total_price,
            'currency' => "BDT",
            'tran_id' => $tran_id,

            'success_url' => route('sslcommerz.success'),
            'fail_url'    => route('sslcommerz.fail'),
            'cancel_url'  => route('sslcommerz.cancel'),

            'cus_name'  => Auth::user()->name,
            'cus_email' => Auth::user()->email,
            'cus_add1'  => $order->shipping_address ?? 'N/A',
            'cus_phone' => $order->phone ?? 'N/A',

            'shipping_method' => "NO",
            'product_name' => "Ecommerce Order",
            'product_category' => "General",
            'product_profile' => "general",
            'num_of_item' => $order->items->count(),
        ];

        $response = Http::asForm()->post(
            $this->base_url . "/gwprocess/v4/api.php",
            $post_data
        );

        $result = $response->json();

        if (isset($result['GatewayPageURL']) && !empty($result['GatewayPageURL'])) {
            return redirect()->away($result['GatewayPageURL']);
        }

        return back()->with(
            'error',
            $result['failedreason'] ?? 'Payment gateway failed. Please check SSLCommerz credentials.'
        );
    }

    public function success(Request $request)
    {
        $tran_id = $request->tran_id;

        if (!$tran_id) {
            return redirect()->route('home')->with('error', 'Invalid transaction');
        }

        $order = Order::where('transaction_id', $tran_id)->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found');
        }

        DB::transaction(function () use ($order) {
            $order->update([
                'payment_status' => 'paid',
                'order_status'   => 'processing'
            ]);
        });

        session()->forget('cart');

        return view('frontend.payment-success', compact('order'));
    }

    public function fail()
    {
        return view('frontend.payment-fail');
    }

    public function cancel()
    {
        return view('frontend.payment-cancel');
    }
}