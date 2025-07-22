@extends('layouts.app')

@section('title', 'Accès refusé')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <!-- Error Icon -->
            <div class="text-8xl text-red-300 mb-8">
                🚫
            </div>

            <!-- Error Code -->
            <h1 class="text-6xl font-bold text-gray-900 mb-4">
                403
            </h1>

            <!-- Error Message -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">
                Accès refusé
            </h2>

            <p class="text-lg text-gray-600 mb-8 max-w-md mx-auto">
                Vous n'avez pas l'autorisation d'accéder à cette page. 
                Seuls les administrateurs peuvent accéder à cette section.
            </p>

            <!-- Action Buttons -->
            <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Retour à l'accueil
                </a>

                @auth
                    @if(!Auth::user()->isAdmin())
                        <button onclick="history.back()" 
                                class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Page précédente
                        </button>
                    @endif
                @endauth
            </div>

            <!-- Contact Info -->
            @auth
                @if(!Auth::user()->isAdmin())
                    <div class="mt-12 p-6 bg-gray-50 rounded-lg max-w-md mx-auto">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            Besoin d'un accès administrateur ?
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Si vous pensez que vous devriez avoir accès à cette page, 
                            contactez votre administrateur système.
                        </p>
                    </div>
                @endif
            @else
                <div class="mt-12 p-6 bg-blue-50 rounded-lg max-w-md mx-auto">
                    <h3 class="text-lg font-medium text-blue-900 mb-2">
                        Vous n'êtes pas connecté
                    </h3>
                    <p class="text-blue-700 text-sm mb-4">
                        Connectez-vous pour accéder à votre compte.
                    </p>
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        Se connecter
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection