@extends('layouts.app')

@section('title', 'Tous les Produits')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">
            Nos Produits
        </h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Découvrez notre sélection de produits de qualité répartis par catégories
        </p>
    </div>

    <!-- Categories Filter (Optional) -->
    <div class="mb-8">
        <div class="flex flex-wrap gap-3 justify-center">
            <a href="{{ route('home') }}" 
               class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ !request('category') ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Tous
            </a>
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category) }}" 
                   class="px-4 py-2 rounded-full text-sm font-medium transition-colors bg-gray-200 text-gray-700 hover:bg-gray-300">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 group">
                    <!-- Product Image Placeholder -->
                    <div class="aspect-square bg-gradient-to-br from-indigo-50 to-purple-50 rounded-t-lg flex items-center justify-center group-hover:from-indigo-100 group-hover:to-purple-100 transition-colors">
                        <div class="text-6xl text-indigo-200">
                            📱
                        </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="p-6">
                        <!-- Category Badge -->
                        <div class="flex items-center justify-between mb-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                {{ $product->category->name }}
                            </span>
                            @if($product->stock_quantity <= 5)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Stock faible
                                </span>
                            @endif
                        </div>

                        <!-- Product Name -->
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">
                            <a href="{{ route('products.show', $product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </h3>

                        <!-- Product Description -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ Str::limit($product->description, 100) }}
                        </p>

                        <!-- Price and Stock -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-2xl font-bold text-indigo-600">
                                {{ number_format($product->price, 2) }} €
                            </div>
                            <div class="text-sm text-gray-500">
                                Stock: {{ $product->stock_quantity }}
                            </div>
                        </div>

                        <!-- Action Button -->
                        <a href="{{ route('products.show', $product->slug) }}" 
                           class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md text-sm font-medium hover:bg-indigo-700 transition-colors duration-200 text-center block">
                            Voir le produit
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $products->links('pagination::tailwind') }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="text-6xl text-gray-300 mb-4">📦</div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                Aucun produit trouvé
            </h3>
            <p class="text-gray-600">
                Il n'y a actuellement aucun produit disponible.
            </p>
        </div>
    @endif
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection