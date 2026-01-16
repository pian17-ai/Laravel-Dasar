<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        return view('posts.index', ['posts' => Post::all()]);
    }

    // public function show(Post $post) {

    // }

    public function store(Request $request) {
        Post::create($request->all());
        return back();
    }

    public function update() {

    }

    public function destroy() {

    }
}
