<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //CHECKOUT PAGE
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/')
                ->with('error', 'Your cart is empty!');
        }

        return view('frontend.checkout', compact('cart'));
    }
}