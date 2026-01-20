<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2000',
            'title' => 'required|min:4',
            'description' => 'min:8',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $image = $request->file('image');
        $image->storeAs('products', $image->hashName());

        Product::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        return redirect()->route('products.index')->with(['success' => 'Data berhasil disimpan']);
    }

    public function show(string $id): View
    {
        $product = Product::findOrFail($id);

        return View('products.show', compact('product'));
    }

    public function edit(string $id): View
    {
        $product = Product::findOrFail($id);

        return View('products.show', compact('product'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2000',
            'title' => 'required|min:4',
            'description' => 'min:8',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $image = $request->file('image');
        $image->storeAs('products', $image->hashName());

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::delete('products/' . $product->image);
            $image = $request->file('image');
            $image->storeAs('products', $image->hashName());

            $product::update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock
            ]);
        } else {
            $product::update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock
            ]);
        }
        return redirect()->route('products.index')->with(['success' => 'Data berhasil diubah']);
    }

    public function destroy($id):RedirectResponse {
        $product = Product::findOrFail($id);

        Storage::delete('product/' . $product->image);

        $product->delete();

        return redirect()->route('products.index')->with(['success' => 'Data berhasil dihapus']);
    }
}
