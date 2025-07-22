@extends('layouts.app')

@section('title', 'Catégorie : ' . $category->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                    </svg>
                    Tous les produits
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $category->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Category Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">
            {{ $category->name }}
        </h1>
        <p class="text-xl text-gray-600">
            {{ $products->total() }} produit{{ $products->total() > 1 ? 's' : '' }} dans cette catégorie
        </p>
    </div>

    <!-- Categories Filter -->
    <div class="mb-8">
        <div class="flex flex-wrap gap-3 justify-center">
            <a href="{{ route('home') }}" 
               class="px-4 py-2 rounded-full text-sm font-medium transition-colors bg-gray-200 text-gray-700 hover:bg-gray-300">
                Tous
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('categories.show', $cat) }}" 
                   class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ $cat->id === $category->id ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    {{ $cat->name }}
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
                            @if($category->name === 'Smartphones')
                                📱
                            @elseif($category->name === 'Ordinateurs Portables')
                                💻
                            @elseif($category->name === 'Accessoires')
                                🎧
                            @else
                                📦
                            @endif
                        </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="p-6">
                        <!-- Stock Badge -->
                        <div class="flex items-center justify-between mb-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                {{ $category->name }}
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
                Aucun produit dans cette catégorie
            </h3>
            <p class="text-gray-600 mb-6">
                Il n'y a actuellement aucun produit dans la catégorie "{{ $category->name }}".
            </p>
            <a href="{{ route('home') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Voir tous les produits
            </a>
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