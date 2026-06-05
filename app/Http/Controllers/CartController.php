<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        // STATUS CHECK
        if ($product->status == 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product is unavailable!'
            ], 400);
        }

        if ($product->stock <= 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product is out of stock!'
            ], 400);
        }

        $cart = session()->get('cart', []);

        // IMAGE FIX
        $productImage = null;

        if (!empty($product->images)) {

            if (is_array($product->images)) {
                $productImage = $product->images[0] ?? null;
            } else {
                $images = json_decode($product->images, true);
                $productImage = $images[0] ?? null;
            }
        }

        // EXISTING PRODUCT
        if (isset($cart[$id])) {

            if ($cart[$id]['quantity'] >= $product->stock) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Maximum stock limit reached!'
                ], 400);
            }

            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [
                "id"       => $product->id,
                "name"     => $product->name,
                "slug"     => $product->slug,
                "price"    => $product->price,
                "image"    => $productImage,
                "stock"    => $product->stock,
                "quantity" => 1,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart successfully!',
            'cart_count' => count($cart)
        ]);
    }

    //CART PAGE
    public function cartPage()
    {
        $cart = session()->get('cart', []);

        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = count($cart) > 0 ? 5 : 0;
        $total = $subtotal + $shipping;

        return view('frontend.cart', compact('cart', 'subtotal', 'shipping', 'total'));
    }

    //REMOVE ITEM
    public function removeCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product removed successfully!'
        ]);
    }

    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cart item not found!'
            ], 404);
        }

        $product = Product::findOrFail($id);

        if ($request->quantity > $product->stock) {
            return response()->json([
                'status' => 'error',
                'message' => 'Requested quantity exceeds stock!'
            ], 400);
        }

        $cart[$id]['quantity'] = $request->quantity;

        session()->put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'message' => 'Cart updated successfully!'
        ]);
    }

    public function clearCart()
    {
        session()->forget('cart');

        return response()->json([
            'status' => 'success',
            'message' => 'Cart cleared successfully!'
        ]);
    }
}