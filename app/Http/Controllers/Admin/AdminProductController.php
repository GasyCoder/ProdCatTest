<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    // Liste des produits
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Enregistrer un nouveau produit
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($validated);

        return redirect()->route('admin.produits.index')
            ->with('success', 'Produit ajouté avec succès.');
    }


    public function edit(Product $produit)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('produit', 'categories'));
    }

    // Mettre à jour un produit
    public function update(Request $request, Product $produit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $produit->update($validated);

        return redirect()->route('admin.produits.index')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    // Supprimer un produit
    public function destroy(Product $produit)
    {
        $produit->delete();
        return redirect()->route('admin.produits.index')
            ->with('success', 'Produit supprimé avec succès.');
    }

    // Exporter en CSV
    public function exportCsv()
    {
        $products = Product::with('category')->get();
        $filename = 'products_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($products) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Nom', 'Catégorie', 'Prix', 'Stock', 'Description']);
            foreach ($products as $product) {
                fputcsv($file, [
                    $product->id,
                    $product->name,
                    $product->category->name,
                    $product->price,
                    $product->stock_quantity,
                    $product->description,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}