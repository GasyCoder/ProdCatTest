<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Page d'accueil - Afficher tous les produits
     * Route: GET /
     */
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Afficher un produit spécifique par son slug
     * Route: GET /produits/{slug}
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with('category')
            ->firstOrFail();


        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'similarProducts'));
    }
}
