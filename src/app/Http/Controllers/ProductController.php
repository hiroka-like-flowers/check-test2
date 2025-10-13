<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Season;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index() {

        $query = Product::query();
        $price = Product::query();
        $products = $query->paginate(6)->withQueryString();
        $csvData = Product::all();

        return view('products', compact('products', 'csvData'));
    }

    public function show ($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();

        return view('update', compact('product', 'seasons'));
    }

    public function update(ProductRequest $request, $id)
    {
        if ($request->has('back')) {
            return redirect('/products')->withInput();
        }

        $product = Product::findOrFail($id);

        $request->validate(['image' => 'required|image']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/items/fruits-img');
            $path = str_replace('public/', 'storage/', $path);
            $product->image = $path;
        }

        $product->update([
            'image' => $path,
            'name' => $request->name,
            'price' => $request->price,'description' => $request->description,
        ]);
        $product->seasons()->sync($product->season_id ?? []);

        return redirect()->route('/products', $product->id);
    }

    public function showCreateForm()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    public function create(ProductRequest $request)
    {
        if ($request->has('back')) {
            return redirect('/products')->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'descriotion' => $request->descriotion,
            'image' => $imagePath,
        ]);

        return redirect('products');
    }

    public function search(Request $request)
    {
        if ($request->has('reset')) {
            return redirect('/products')->withInput();
        }

        $query = Product::query();
        $query = $this->getSearchQuery($request, $query);

        $products = $query->paginate(6)->withQueryString();
        $csvData = $query->get();

        $price = Product::query();

        $price->when($request->sort, function ($price, $sort) {
            switch ($sort) {
                case 'price_asc':
                    return $price->orderBy('price', 'asc');
                case 'price_desc':
                    return $price->orderBy('price', 'desc');
                    default:
                    return $price->latest();
            }
        }, function ($price) {
            return $price->latest();
        });

        return view('products', compact('products', 'csvData'));
    }

    public function destroy(Request $request)
    {
        Product::find($request->id)->delete();
        return redirect('products');
    }

    private function getSearchQuery($request, $query)
    {
        if(!empty($request->keyword)) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        return $query;
    }
}
