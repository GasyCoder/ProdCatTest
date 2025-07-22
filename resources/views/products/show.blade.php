@extends('layouts.app')

@section('title', isset($product) ? $product->name : 'Produit')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-gray-900">
                    <i class="i-lucide-home w-4 h-4"></i>
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="i-lucide-chevron-right w-4 h-4 text-gray-400 mx-2"></i>
                    <a href="{{ route('categories.show', $product->category) }}" class="text-gray-700 hover:text-gray-900">
                        {{ $product->category->name }}
                    </a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="i-lucide-chevron-right w-4 h-4 text-gray-400 mx-2"></i>
                    <span class="text-gray-500">{{ Str::limit($product->name, 30) }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Product Detail -->
    <div class="lg:grid lg:grid-cols-2 lg:gap-12">
        <!-- Product Image -->
        <div class="mb-8 lg:mb-0">
            <div class="aspect-square bg-gray-100 rounded-xl flex items-center justify-center p-12">
                @if($product->category->name === 'Smartphones')
                    <i class="i-lucide-smartphone w-40 h-40 text-gray-300"></i>
                @elseif($product->category->name === 'Ordinateurs Portables')
                    <i class="i-lucide-laptop w-40 h-40 text-gray-300"></i>
                @elseif($product->category->name === 'Accessoires')
                    <i class="i-lucide-headphones w-40 h-40 text-gray-300"></i>
                @else
                    <i class="i-lucide-package w-40 h-40 text-gray-300"></i>
                @endif
            </div>
        </div>

        <!-- Product Info -->
        <div class="space-y-6">
            <!-- Category Badge -->
            <div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                    @if($product->category->name === 'Smartphones')
                        <i class="i-lucide-smartphone w-4 h-4 mr-2"></i>
                    @elseif($product->category->name === 'Ordinateurs Portables')
                        <i class="i-lucide-laptop w-4 h-4 mr-2"></i>
                    @elseif($product->category->name === 'Accessoires')
                        <i class="i-lucide-headphones w-4 h-4 mr-2"></i>
                    @else
                        <i class="i-lucide-package w-4 h-4 mr-2"></i>
                    @endif
                    {{ $product->category->name }}
                </span>
            </div>

            <!-- Product Name -->
            <h1 class="text-3xl font-bold text-gray-900 leading-tight">{{ $product->name }}</h1>

            <!-- Price -->
            <div class="text-4xl font-bold text-gray-900">
                {{ number_format($product->price, 2) }} €
            </div>

            <!-- Stock Status -->
            <div class="space-y-2">
                @if($product->stock_quantity > 0)
                    <div class="flex items-center text-green-600">
                        <i class="i-lucide-check-circle w-5 h-5 mr-2"></i>
                        <span class="font-semibold">En stock</span>
                        <span class="text-gray-600 ml-2">({{ $product->stock_quantity }} disponible{{ $product->stock_quantity > 1 ? 's' : '' }})</span>
                    </div>
                    @if($product->stock_quantity <= 5)
                        <div class="flex items-center text-yellow-600 text-sm">
                            <i class="i-lucide-alert-triangle w-4 h-4 mr-2"></i>
                            Plus que {{ $product->stock_quantity }} en stock, commandez rapidement !
                        </div>
                    @endif
                @else
                    <div class="flex items-center text-red-600">
                        <i class="i-lucide-x-circle w-5 h-5 mr-2"></i>
                        <span class="font-semibold">Rupture de stock</span>
                    </div>
                @endif
            </div>

            <!-- Description -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                    <i class="i-lucide-info w-5 h-5 mr-2"></i>
                    Description
                </h3>
                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
            </div>

            <!-- Product Details -->
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="i-lucide-file-text w-5 h-5 mr-2"></i>
                    Détails techniques
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Référence</span>
                        <span class="text-gray-900 font-mono text-sm">{{ $product->slug }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Catégorie</span>
                        <span class="text-gray-900">{{ $product->category->name }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Stock</span>
                        <span class="text-gray-900">{{ $product->stock_quantity }} unité{{ $product->stock_quantity > 1 ? 's' : '' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Disponibilité</span>
                        <span class="text-gray-900">{{ $product->stock_quantity > 0 ? 'En stock' : 'Indisponible' }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @if($product->stock_quantity > 0)
                        <button class="flex items-center justify-center px-6 py-4 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-700 transition-colors">
                            <i class="i-lucide-shopping-cart w-5 h-5 mr-2"></i>
                            Ajouter au panier
                        </button>
                    @else
                        <button disabled class="flex items-center justify-center px-6 py-4 bg-gray-300 text-gray-500 font-semibold rounded-lg cursor-not-allowed">
                            <i class="i-lucide-x w-5 h-5 mr-2"></i>
                            Indisponible
                        </button>
                    @endif
                    
                    <button class="flex items-center justify-center px-6 py-4 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="i-lucide-heart w-5 h-5 mr-2"></i>
                        Ajouter aux favoris
                    </button>
                </div>

                <!-- Back Button -->
                <div class="pt-4 border-t border-gray-200">
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center text-gray-600 hover:text-gray-900 font-medium transition-colors">
                        <i class="i-lucide-arrow-left w-4 h-4 mr-2"></i>
                        Retour aux produits
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Similar Products -->
    @if($similarProducts->count() > 0)
        <div class="mt-20">
            <div class="flex items-center mb-8">
                <i class="i-lucide-heart w-6 h-6 text-gray-600 mr-3"></i>
                <h2 class="text-2xl font-bold text-gray-900">Produits similaires</h2>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($similarProducts as $similar)
                    <x-product-card :product="$similar" />
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection