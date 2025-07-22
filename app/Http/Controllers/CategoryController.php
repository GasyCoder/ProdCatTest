<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Afficher les produits d'une catégorie
     * Route: GET /categories/{category}
     */
    public function show(Category $category)
    {
        $products = $category->products()
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = Category::orderBy('name')->get();

        return view('categories.show', compact('category', 'products', 'categories'));
    }
}