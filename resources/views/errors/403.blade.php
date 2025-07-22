@extends('layouts.app')

@section('title', 'Accès refusé')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <!-- Error Icon -->
            <div class="mb-8">
                <i class="fas fa-lock text-6xl text-red-400"></i>
            </div>

            <!-- Error Code -->
            <h1 class="text-4xl font-bold text-gray-900 mb-4">403</h1>

            <!-- Error Message -->
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Accès refusé</h2>

            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                Vous n'avez pas l'autorisation d'accéder à cette page. 
                Seuls les administrateurs peuvent accéder à cette section.
            </p>

            <!-- Action Buttons -->
            <div class="space-y-3 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                    <i class="fas fa-home mr-2"></i>
                    Retour à l'accueil
                </a>

                @auth
                    @if(!Auth::user()->isAdmin())
                        <button onclick="history.back()" 
                                class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Page précédente
                        </button>
                    @endif
                @endauth
            </div>

            <!-- Contact Info -->
            @auth
                @if(!Auth::user()->isAdmin())
                    <div class="mt-8 p-6 bg-gray-50 rounded-lg max-w-md mx-auto">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            <i class="fas fa-question-circle mr-2"></i>
                            Besoin d'un accès administrateur ?
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Si vous pensez que vous devriez avoir accès à cette page, 
                            contactez votre administrateur système.
                        </p>
                    </div>
                @endif
            @else
                <div class="mt-8 p-6 bg-blue-50 rounded-lg max-w-md mx-auto">
                    <h3 class="text-lg font-medium text-blue-900 mb-2">
                        <i class="fas fa-info-circle mr-2"></i>
                        Vous n'êtes pas connecté
                    </h3>
                    <p class="text-blue-700 text-sm mb-4">
                        Connectez-vous pour accéder à votre compte.
                    </p>
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Se connecter
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection