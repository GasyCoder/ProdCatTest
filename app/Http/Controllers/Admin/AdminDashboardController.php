<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistiques pour le dashboard
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_users' => User::where('type', 'user')->count(),
            'total_admins' => User::where('type', 'admin')->count(),
            'low_stock_products' => Product::where('stock_quantity', '<=', 5)->count(),
            'out_of_stock_products' => Product::where('stock_quantity', 0)->count(),
        ];

        // Derniers produits ajoutés
        $recent_products = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        // Produits en stock faible
        $low_stock_products = Product::with('category')
            ->where('stock_quantity', '<=', 5)
            ->where('stock_quantity', '>', 0)
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_products', 'low_stock_products'));
    }
}