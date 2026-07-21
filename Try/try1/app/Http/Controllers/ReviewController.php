<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function store(Request $request) {
        $user = $request->user();

        if(!$user) {
            return response()->json([
                'messages' => 'Unauthorized'
            ]);
        }

        $validated = $request->validate([
            'book' => 'required|exists:books,id',
            'messages' => 'required',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        Review::create([
            'user' => $user->id,
            'book' => $request->book_id,
            'messages' => $request->messages,
            'rating' => $request->rating
        ]);

        return response()->json([
            'messages' => 'Review done send'
        ]);
    }
}
