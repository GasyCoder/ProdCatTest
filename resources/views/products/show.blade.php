@extends('layouts.app')

@section('title', $product->name)

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
                    Accueil
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('categories.show', $product->category) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">
                        {{ $product->category->name }}
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($product->name, 30) }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Product Detail -->
    <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
        <!-- Product Image -->
        <div class="flex flex-col-reverse">
            <div class="aspect-square w-full bg-gradient-to-br from-indigo-50 to-purple-50 rounded-lg flex items-center justify-center">
                <div class="text-8xl text-indigo-200">
                    📱
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
            <!-- Category Badge -->
            <div class="mb-4">
                <a href="{{ route('categories.show', $product->category) }}" 
                   class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 hover:bg-indigo-200 transition-colors">
                    {{ $product->category->name }}
                </a>
            </div>

            <!-- Product Name -->
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                {{ $product->name }}
            </h1>

            <!-- Price -->
            <div class="mt-3">
                <h2 class="sr-only">Informations produit</h2>
                <p class="text-3xl tracking-tight text-indigo-600 font-bold">
                    {{ number_format($product->price, 2) }} €
                </p>
            </div>

            <!-- Stock Status -->
            <div class="mt-6">
                @if($product->stock_quantity > 0)
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-green-600 font-medium">
                            En stock ({{ $product->stock_quantity }} disponible{{ $product->stock_quantity > 1 ? 's' : '' }})
                        </span>
                    </div>
                    @if($product->stock_quantity <= 5)
                        <p class="text-orange-600 text-sm mt-1">Plus que {{ $product->stock_quantity }} en stock !</p>
                    @endif
                @else
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-red-600 font-medium">Rupture de stock</span>
                    </div>
                @endif
            </div>

            <!-- Description -->
            <div class="mt-6">
                <h3 class="text-lg font-medium text-gray-900">Description</h3>
                <div class="mt-3 text-gray-600 space-y-4">
                    <p>{{ $product->description }}</p>
                </div>
            </div>

            <!-- Product Details -->
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900">Détails</h3>
                <div class="mt-4 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Référence :</span>
                        <span class="text-gray-900 font-medium">{{ $product->slug }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Catégorie :</span>
                        <span class="text-gray-900 font-medium">{{ $product->category->name }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Stock :</span>
                        <span class="text-gray-900 font-medium">{{ $product->stock_quantity }} unité{{ $product->stock_quantity > 1 ? 's' : '' }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                @if($product->stock_quantity > 0)
                    <button type="button" 
                            class="flex-1 bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Ajouter au panier
                    </button>
                @else
                    <button type="button" 
                            disabled
                            class="flex-1 bg-gray-300 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-gray-500 cursor-not-allowed">
                        Indisponible
                    </button>
                @endif
                
                <button type="button" 
                        class="flex-1 bg-gray-50 border border-gray-300 rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    ♡ Favoris
                </button>
            </div>

            <!-- Back Button -->
            <div class="mt-6">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Retour aux produits
                </a>
            </div>
        </div>
    </div>

    <!-- Similar Products -->
    @if($similarProducts->count() > 0)
        <div class="mt-20">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Produits similaires</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($similarProducts as $similarProduct)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 group">
                        <!-- Product Image -->
                        <div class="aspect-square bg-gradient-to-br from-gray-50 to-gray-100 rounded-t-lg flex items-center justify-center group-hover:from-gray-100 group-hover:to-gray-200 transition-colors">
                            <div class="text-4xl text-gray-300">📱</div>
                        </div>
                        
                        <!-- Product Info -->
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">
                                <a href="{{ route('products.show', $similarProduct->slug) }}">
                                    {{ Str::limit($similarProduct->name, 40) }}
                                </a>
                            </h3>
                            <div class="flex items-center justify-between">
                                <div class="text-lg font-bold text-indigo-600">
                                    {{ number_format($similarProduct->price, 2) }} €
                                </div>
                                <a href="{{ route('products.show', $similarProduct->slug) }}" 
                                   class="text-sm text-indigo-600 hover:text-indigo-500 font-medium">
                                    Voir →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection