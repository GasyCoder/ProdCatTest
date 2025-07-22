@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
        <p class="text-gray-600">Tableau de bord administrateur</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Produits -->
        <div class="bg-white rounded-lg border p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="i-lucide-package w-8 h-8 text-gray-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_products'] }}</p>
                    <p class="text-sm text-gray-600">Produits</p>
                </div>
            </div>
        </div>

        <!-- Total Catégories -->
        <div class="bg-white rounded-lg border p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="i-lucide-tag w-8 h-8 text-gray-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_categories'] }}</p>
                    <p class="text-sm text-gray-600">Catégories</p>
                </div>
            </div>
        </div>

        <!-- Total Utilisateurs -->
        <div class="bg-white rounded-lg border p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="i-lucide-users w-8 h-8 text-gray-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                    <p class="text-sm text-gray-600">Utilisateurs</p>
                </div>
            </div>
        </div>

        <!-- Stock Faible -->
        <div class="bg-white rounded-lg border p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="i-lucide-alert-triangle w-8 h-8 text-yellow-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-yellow-600">{{ $stats['low_stock_products'] }}</p>
                    <p class="text-sm text-gray-600">Stock faible</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Derniers Produits -->
        <div class="bg-white rounded-lg border">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Derniers Produits</h2>
            </div>
            <div class="p-6">
                @if($recent_products->count() > 0)
                    <div class="space-y-4">
                        @foreach($recent_products as $product)
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">{{ Str::limit($product->name, 30) }}</p>
                                    <p class="text-sm text-gray-600">{{ $product->category->name }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">{{ number_format($product->price, 2) }} €</p>
                                    <p class="text-sm text-gray-600">Stock: {{ $product->stock_quantity }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.produits.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                            Voir tous les produits →
                        </a>
                    </div>
                @else
                    <p class="text-gray-600">Aucun produit trouvé</p>
                @endif
            </div>
        </div>

        <!-- Stock Faible -->
        <div class="bg-white rounded-lg border">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Stock Faible</h2>
            </div>
            <div class="p-6">
                @if($low_stock_products->count() > 0)
                    <div class="space-y-4">
                        @foreach($low_stock_products as $product)
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">{{ Str::limit($product->name, 30) }}</p>
                                    <p class="text-sm text-gray-600">{{ $product->category->name }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="i-lucide-alert-triangle w-3 h-3 mr-1"></i>
                                        {{ $product->stock_quantity }} restants
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">Aucun produit en stock faible</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="mt-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions rapides</h2>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.produits.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-700 transition-colors">
                <i class="i-lucide-plus w-4 h-4 mr-2"></i>
                Nouveau Produit
            </a>
            <a href="{{ route('admin.categories.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="i-lucide-plus w-4 h-4 mr-2"></i>
                Nouvelle Catégorie
            </a>
            <a href="{{ route('admin.produits.export') }}" 
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="i-lucide-download w-4 h-4 mr-2"></i>
                Exporter CSV
            </a>
        </div>
    </div>
</div>
@endsection