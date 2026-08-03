<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Add / Remove Wishlist
    public function toggle($productId)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Please login first!',
                'count' => 0,
            ], 401);
        }

        $userId = Auth::id();

        $wishlist = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();

            $count = Wishlist::where('user_id', $userId)->count();

            return response()->json([
                'success' => true,
                'status'  => 'removed',
                'message' => 'Removed from wishlist',
                'count'   => $count,
            ]);
        }

        Wishlist::firstOrCreate([
            'user_id'    => $userId,
            'product_id' => $productId,
        ]);

        $count = Wishlist::where('user_id', $userId)->count();

        return response()->json([
            'success' => true,
            'status'  => 'added',
            'message' => 'Added to wishlist',
            'count'   => $count,
        ]);
    }

    // Wishlist Page
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('frontend.wishlist', compact('wishlists'));
    }
}