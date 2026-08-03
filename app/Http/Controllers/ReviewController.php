<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // ❌ Check login
        if (!Auth::check()) {
            return back()->with('error', 'Please login first!');
        }

        // ⭐ Create review
        Review::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // 🎉 SUCCESS MESSAGE (THIS IS IMPORTANT)
        return back()->with('success', 'Review submitted successfully!');
    }
}