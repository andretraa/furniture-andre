<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FurnitureController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter category
        if ($request->has('category') && $request->category !== 'All' && !empty($request->category)) {
            $query->where('category', $request->category);
        }

        // Search term
        if ($request->has('q') && !empty($request->q)) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('material', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sort = $request->get('sort', 'featured');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('is_new', 'desc')->orderBy('created_at', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'featured':
            default:
                $query->orderBy('is_featured', 'desc')->orderBy('id', 'asc');
                break;
        }

        $products = $query->get();

        $featuredProducts = Product::where('is_featured', true)->take(3)->get();
        $categories = ['All', 'Living Room', 'Bedroom', 'Dining Room', 'Office', 'Outdoor'];

        return view('home', [
            'products' => $products,
            'featuredProducts' => $featuredProducts,
            'categories' => $categories,
            'selectedCategory' => $request->get('category', 'All'),
            'searchQuery' => $request->get('q', ''),
            'selectedSort' => $sort,
        ]);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'product' => $product,
                'formatted_price' => $product->formatted_price,
                'formatted_original_price' => $product->formatted_original_price,
                'related' => $relatedProducts,
            ]);
        }

        return view('product-detail', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
