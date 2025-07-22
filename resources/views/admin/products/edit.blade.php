@extends('layouts.app')

@section('title', 'Modifier un produit')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <x-breadcrumb :items="[
        ['label' => 'Produits', 'url' => route('admin.produits.index')],
        ['label' => 'Modifier']
    ]" />


    <h1 class="text-2xl font-bold text-gray-900 mb-6">Modifier le produit</h1>

    <form action="{{ route('admin.produits.update', $produit) }}" method="POST" class="bg-white rounded-lg border p-6">
        @csrf
        @method('PATCH')
        <div class="grid grid-cols-1 gap-6">
            <!-- Nom -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', $produit->name) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900 sm:text-sm @error('name') border-red-300 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catégorie -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
                <select name="category_id" id="category_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900 sm:text-sm @error('category_id') border-red-300 @enderror">
                    <option value="">Sélectionner une catégorie</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $produit->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Prix -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Prix (€)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $produit->price) }}" step="0.01"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900 sm:text-sm @error('price') border-red-300 @enderror">
                @error('price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stock -->
            <div>
                <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Quantité en stock</label>
                <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $produit->stock_quantity) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900 sm:text-sm @error('stock_quantity') border-red-300 @enderror">
                @error('stock_quantity')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900 sm:text-sm @error('description') border-red-300 @enderror">{{ old('description', $produit->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-4">
            <a href="{{ route('admin.produits.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                Annuler
            </a>
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-700 disabled:opacity-50"
                id="submit-button">
                <span id="button-text">Mettre à jour</span>
                <span id="loader" class="hidden flex items-center">
                    <span class="inline-block h-5 w-5 border-4 border-t-transparent border-white rounded-full animate-spin mr-2"></span>
                    Chargement...
                </span>
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('product-form').addEventListener('submit', function () {
        const submitButton = document.getElementById('submit-button');
        const buttonText = document.getElementById('button-text');
        const loader = document.getElementById('loader');

        submitButton.disabled = true;
        buttonText.classList.add('hidden');
        loader.classList.remove('hidden');
    });
</script>
@endsection