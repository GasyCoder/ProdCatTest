<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = Category::withCount('products')->orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        // Debug : afficher le slug reçu
        \Log::info('Slug reçu: ' . $slug);
        
        // Debug : vérifier si le produit existe
        $productExists = Product::where('slug', $slug)->exists();
        \Log::info('Produit existe: ' . ($productExists ? 'oui' : 'non'));
        
        // Debug : afficher tous les slugs disponibles
        $allSlugs = Product::pluck('slug')->toArray();
        \Log::info('Tous les slugs: ' . implode(', ', $allSlugs));
        
        $product = Product::where('slug', $slug)->with('category')->firstOrFail();
        
        \Log::info('Produit trouvé: ' . $product->name);
        
        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'similarProducts'));
    }
}