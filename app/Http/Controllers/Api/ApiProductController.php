<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ApiProductController extends Controller
{

    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json([
            'message' => 'Produits récupérés avec succès',
            'data' => $products
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ], [
            'name.required' => 'Le nom du produit est requis.',
            'price.required' => 'Le prix est requis.',
            'stock_quantity.required' => 'La quantité en stock est requise.',
            'category_id.required' => 'La catégorie est requise.',
            'category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $product = Product::create($validated);

        return response()->json([
            'message' => 'Produit créé avec succès',
            'data' => $product
        ], Response::HTTP_CREATED);
    }
}