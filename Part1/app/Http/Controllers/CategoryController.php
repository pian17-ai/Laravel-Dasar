<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();

        return response()->json([
            'messages' => 'success',
            'data' => $categories
        ]);
    }

    public function show($id) {
        $category = Category::findOrFail($id);

        return response()->json([
            'messages' => 'success',
            'data' => $category
        ]);
    }

    public function insert(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $category = Category::create($validated);

        return response()->json([
            'messages' => 'success',
            'data' => $category
        ]);
    }

    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);

        if ($category == null) {
            return response()->json([
                'messages' => 'Category not found'
            ]);
        }

        $category->update($request->all());

        return response()->json([
            'messages' => 'success',
            'data' => $category
        ]);
    }

    public function destroy($id) {
        $category = Category::findOrFail($id);

        if ($category == null) {
            return response()->json([
                'messages' => 'Category not found'
            ]);
        }

        $category->delete();

        return response()->json([
            'messages' => 'deleted'
        ]);
    }
}
