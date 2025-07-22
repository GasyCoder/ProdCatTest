@extends('layouts.app')

@section('title', 'Modifier une catégorie')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <x-breadcrumb :items="[
        ['label' => 'Catégories', 'url' => route('admin.categories.index')],
        ['label' => 'Modifier']
    ]" />

    <h1 class="text-2xl font-bold text-gray-900 mb-6">Modifier la catégorie</h1>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="bg-white rounded-lg border p-6">
        @csrf
        @method('PATCH')
        <div class="grid grid-cols-1 gap-6">
            <!-- Nom -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900 sm:text-sm @error('name') border-red-300 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-4">
            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                Annuler
            </a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-700">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection