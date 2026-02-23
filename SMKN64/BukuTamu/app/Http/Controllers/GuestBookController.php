<?php

namespace App\Http\Controllers;

use App\Models\GuestBook;
use Illuminate\Http\Request;

class GuestBookController extends Controller
{
    public function index() {
        $guest_books = GuestBook::get();

        return response()->json([
            'guest_books' => $guest_books
        ]);
    }

    public function show($id) {
        $guest_book = GuestBook::where('id', $id)->first();

        return response()->json([
            'guest_book' => $guest_book
        ]);
    }

    public function store(Request $request) {
        $user = $request->user();

        $request->validate([
            'message' => 'required'
        ]);

        $guest_book = GuestBook::create([
            'user_id' => $user->id,
            'message' => $request->message,
            'image' => $request->image
        ]);

        return response()->json([
            'guest_book' => $guest_book
        ]);
    }

    public function destroy($id) {
        $guest_book = GuestBook::where('id', $id)->first();

        $guest_book->delete();

        return response()->json([
            'message' => 'delete success'
        ]);
    }
}
