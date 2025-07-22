@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Bienvenue, {{ $user->name }} !</h1>
        <p class="text-gray-600">Votre espace personnel</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg border p-6">
            <div class="flex items-center">
                <i class="i-lucide-user w-8 h-8 text-gray-600"></i>
                <div class="ml-4">
                    <p class="text-lg font-semibold text-gray-900">Profil</p>
                    <p class="text-sm text-gray-600">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border p-6">
            <div class="flex items-center">
                <i class="i-lucide-package w-8 h-8 text-gray-600"></i>
                <div class="ml-4">
                    <p class="text-lg font-semibold text-gray-900">Produits</p>
                    <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        Voir le catalogue →
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border p-6">
            <div class="flex items-center">
                <i class="i-lucide-settings w-8 h-8 text-gray-600"></i>
                <div class="ml-4">
                    <p class="text-lg font-semibold text-gray-900">Paramètres</p>
                    <a href="{{ route('profile.edit') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        Modifier profil →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg border p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions rapides</h2>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-700 transition-colors">
                <i class="i-lucide-shopping-bag w-4 h-4 mr-2"></i>
                Voir les produits
            </a>
            <a href="{{ route('profile.edit') }}" 
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="i-lucide-user-cog w-4 h-4 mr-2"></i>
                Modifier mon profil
            </a>
        </div>
    </div>
</div>
@endsection