<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // ================= ADD TO CART =================
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        // If already exists
        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()
            ->with('success', 'Product added to cart!');
    }

    // ================= CART PAGE =================
    public function cartPage()
    {
        return view('frontend.cart');
    }

    // ================= REMOVE ITEM =================
    public function removeCart($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {

            unset($cart[$id]);

            session()->put('cart', $cart);
        }

        return redirect()->back()
            ->with('success', 'Item removed!');
    }

    // ================= UPDATE QUANTITY =================
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {

            $cart[$id]['quantity'] = $request->quantity;

            session()->put('cart', $cart);
        }

        return redirect()->back()
            ->with('success', 'Cart updated!');
    }
}