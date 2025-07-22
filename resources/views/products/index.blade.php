@extends('layouts.app')

@section('title', 'Tous les Produits')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Nos Produits</h1>
        <p class="text-lg text-gray-600">
            {{ $products->total() }} produit{{ $products->total() > 1 ? 's' : '' }} dans notre catalogue
        </p>
    </div>

    <!-- Categories Filter Component -->
    <x-category-filter :categories="$categories" />

    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-6 mb-8">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $products->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <i class="i-lucide-package-open w-24 h-24 text-gray-300 mx-auto mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucun produit trouvé</h3>
            <p class="text-gray-600 mb-6">Il n'y a actuellement aucun produit disponible dans notre catalogue.</p>
            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-700">
                <i class="i-lucide-refresh-cw w-4 h-4 mr-2"></i>
                Actualiser
            </a>
        </div>
    @endif
</div>
@endsection