@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Profil</h1>
            <p class="text-gray-600">Gérez les informations de votre compte</p>
        </div>

        @if (session('status') === 'profile-updated')
            <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-r">
                <div class="flex items-center">
                    <i class="i-lucide-check-circle w-5 h-5 text-green-400 mr-3"></i>
                    <span class="text-green-700 font-medium">Profil mis à jour avec succès !</span>
                </div>
            </div>
        @endif

        @if (session('status') === 'password-updated')
            <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-r">
                <div class="flex items-center">
                    <i class="i-lucide-check-circle w-5 h-5 text-green-400 mr-3"></i>
                    <span class="text-green-700 font-medium">Mot de passe mis à jour avec succès !</span>
                </div>
            </div>
        @endif

        <!-- Update Profile Information -->
        <div class="bg-white rounded-lg border p-6">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Informations du profil</h2>
                <p class="text-sm text-gray-600">Mettez à jour vos informations personnelles</p>
            </div>

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                    <input type="text" 
                           name="name" 
                           id="name"
                           value="{{ old('name', $user->name) }}"
                           required
                           class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" 
                           name="email" 
                           id="email"
                           value="{{ old('email', $user->email) }}"
                           required
                           class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type (lecture seule) -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type de compte</label>
                    <div class="block w-full p-3 border border-gray-300 bg-gray-50 rounded-md text-gray-600">
                        {{ $user->isAdmin() ? 'Administrateur' : 'Utilisateur' }}
                    </div>
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="i-lucide-save w-4 h-4 mr-2"></i>
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>

        <!-- Update Password -->
        <div class="bg-white rounded-lg border p-6">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Changer le mot de passe</h2>
                <p class="text-sm text-gray-600">Assurez-vous d'utiliser un mot de passe long et sécurisé</p>
            </div>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <!-- Current Password -->
                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe actuel</label>
                    <input type="password" 
                           name="current_password" 
                           id="current_password"
                           class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('current_password', 'updatePassword')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe</label>
                    <input type="password" 
                           name="password" 
                           id="password"
                           class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('password', 'updatePassword')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
                    <input type="password" 
                           name="password_confirmation" 
                           id="password_confirmation"
                           class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('password_confirmation', 'updatePassword')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="i-lucide-key w-4 h-4 mr-2"></i>
                        Changer le mot de passe
                    </button>
                </div>
            </form>
        </div>

        <!-- Delete Account -->
        <div class="bg-white rounded-lg border border-red-200 p-6">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-red-600">Supprimer le compte</h2>
                <p class="text-sm text-gray-600">Une fois votre compte supprimé, toutes ses données seront définitivement effacées</p>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?')">
                @csrf
                @method('delete')

                <div class="mb-4">
                    <label for="password_delete" class="block text-sm font-medium text-gray-700 mb-2">Confirmez avec votre mot de passe</label>
                    <input type="password" 
                           name="password" 
                           id="password_delete"
                           placeholder="Mot de passe"
                           class="block w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500">
                    @error('password', 'userDeletion')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <i class="i-lucide-trash-2 w-4 h-4 mr-2"></i>
                    Supprimer le compte
                </button>
            </form>
        </div>

        <!-- Retour -->
        <div class="pt-4 border-t border-gray-200">
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center text-gray-600 hover:text-gray-900 font-medium transition-colors">
                <i class="i-lucide-arrow-left w-4 h-4 mr-2"></i>
                Retour au dashboard
            </a>
        </div>
    </div>
</div>
@endsection