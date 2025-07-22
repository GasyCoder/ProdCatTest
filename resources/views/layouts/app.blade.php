<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ProdCat - Gestion de produits et catégories">
    <meta name="keywords" content="produits, catégories, gestion, e-commerce">
    <meta name="author" content="Florent BEZARA">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ProdCat') }} - @yield('title', 'Accueil')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 font-sans min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo et Navigation principale -->
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900 hover:text-gray-700 transition-colors">
                            ProdCat
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                        <a href="{{ route('home') }}" 
                           class="inline-flex items-center px-1 pt-1 pb-1 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('home') ? 'text-gray-900 border-b-2 border-gray-900' : 'text-gray-500 hover:text-gray-900 hover:border-gray-300 border-b-2 border-transparent' }}">
                            <i class="i-lucide-package w-4 h-4 mr-2"></i>
                            Produits
                        </a>
                        
                        <!-- Dropdown Catégories -->
                        <div class="relative">
                            <button id="categories-dropdown-btn" 
                                    class="inline-flex items-center px-1 pt-1 pb-1 text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors duration-200 border-b-2 border-transparent hover:border-gray-300 focus:outline-none"
                                    onclick="toggleDropdown('categories-dropdown')">
                                <i class="i-lucide-tag w-4 h-4 mr-2"></i>
                                Catégories
                                <i class="i-lucide-chevron-down w-3 h-3 ml-1"></i>
                            </button>
                            
                            <div id="categories-dropdown" class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50 hidden border border-gray-200">
                                @if(\App\Models\Category::count() > 0)
                                    @foreach(\App\Models\Category::orderBy('name')->get() as $category)
                                        <a href="{{ route('categories.show', $category) }}" 
                                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                            @if($category->name === 'Smartphones')
                                                <i class="i-lucide-smartphone w-4 h-4 mr-3 text-gray-400"></i>
                                            @elseif($category->name === 'Ordinateurs Portables')
                                                <i class="i-lucide-laptop w-4 h-4 mr-3 text-gray-400"></i>
                                            @elseif($category->name === 'Accessoires')
                                                <i class="i-lucide-headphones w-4 h-4 mr-3 text-gray-400"></i>
                                            @else
                                                <i class="i-lucide-package w-4 h-4 mr-3 text-gray-400"></i>
                                            @endif
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                @else
                                    <div class="px-4 py-2 text-sm text-gray-500">
                                        Aucune catégorie disponible
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu utilisateur -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    @auth
                        <!-- Dropdown utilisateur -->
                        <div class="relative">
                            <button id="user-dropdown-btn"
                                    class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none transition-colors duration-200"
                                    onclick="toggleDropdown('user-dropdown')">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-gray-600 font-semibold text-sm">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div class="text-left">
                                    <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500">
                                        {{ Auth::user()->isAdmin() ? 'Administrateur' : 'Utilisateur' }}
                                    </div>
                                </div>
                                <i class="i-lucide-chevron-down w-3 h-3 ml-2"></i>
                            </button>

                            <div id="user-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden border border-gray-200">
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" 
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                        <i class="i-lucide-layout-dashboard w-4 h-4 mr-3 text-gray-400"></i>
                                        Dashboard Admin
                                    </a>
                                @endif
                                <a href="{{ route('profile.edit') }}" 
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                    <i class="i-lucide-user w-4 h-4 mr-3 text-gray-400"></i>
                                    Mon Profil
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <i class="i-lucide-log-out w-4 h-4 mr-3 text-red-400"></i>
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Liens de connexion -->
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('login') }}" 
                               class="flex items-center text-gray-700 hover:text-gray-900 transition-colors font-medium">
                                <i class="i-lucide-log-in w-4 h-4 mr-1"></i>
                                Connexion
                            </a>
                            <a href="{{ route('register') }}" 
                               class="flex items-center bg-gray-900 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-700 transition-colors shadow-sm">
                                <i class="i-lucide-user-plus w-4 h-4 mr-1"></i>
                                Inscription
                            </a>
                        </div>
                    @endauth
                </div>

                <!-- Bouton menu mobile -->
                <div class="sm:hidden">
                    <button id="mobile-menu-btn" 
                            class="text-gray-700 hover:text-gray-900 focus:outline-none p-2"
                            onclick="toggleMobileMenu()">
                        <i class="i-lucide-menu w-6 h-6" id="mobile-menu-icon"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu mobile -->
        <div id="mobile-menu" class="sm:hidden hidden border-t border-gray-200">
            <div class="pt-2 pb-3 space-y-1 px-4 bg-gray-50">
                <a href="{{ route('home') }}" 
                   class="flex items-center py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-gray-900' : 'text-gray-700' }} hover:text-gray-900 transition-colors">
                    <i class="i-lucide-package w-4 h-4 mr-3"></i>
                    Produits
                </a>
                
                <div class="py-2 text-sm font-medium text-gray-500 border-t border-gray-200 mt-2 pt-3">
                    Catégories :
                </div>
                @if(\App\Models\Category::count() > 0)
                    @foreach(\App\Models\Category::orderBy('name')->get() as $category)
                        <a href="{{ route('categories.show', $category) }}" 
                           class="block py-2 pl-6 text-sm text-gray-600 hover:text-gray-900 transition-colors">
                            {{ $category->name }}
                        </a>
                    @endforeach
                @endif

                @auth
                    <div class="border-t border-gray-200 mt-3 pt-3">
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" 
                               class="flex items-center py-2 text-sm text-gray-700 hover:text-gray-900 transition-colors">
                                <i class="i-lucide-layout-dashboard w-4 h-4 mr-3"></i>
                                Dashboard Admin
                            </a>
                        @endif
                        <a href="{{ route('profile.edit') }}" 
                           class="flex items-center py-2 text-sm text-gray-700 hover:text-gray-900 transition-colors">
                            <i class="i-lucide-user w-4 h-4 mr-3"></i>
                            Mon Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" 
                                    class="flex items-center w-full py-2 text-sm text-red-600 hover:text-red-700 transition-colors">
                                <i class="i-lucide-log-out w-4 h-4 mr-3"></i>
                                Déconnexion
                            </button>
                        </form>
                    </div>
                @else
                    <div class="border-t border-gray-200 mt-3 pt-3 space-y-2">
                        <a href="{{ route('login') }}" 
                           class="flex items-center py-2 text-sm text-gray-700 hover:text-gray-900 transition-colors">
                            <i class="i-lucide-log-in w-4 h-4 mr-3"></i>
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" 
                           class="flex items-center py-2 text-sm bg-gray-900 text-white rounded px-3 hover:bg-gray-700 transition-colors">
                            <i class="i-lucide-user-plus w-4 h-4 mr-3"></i>
                            Inscription
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <main class="py-6 flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-gray-500">
                <p>&copy; {{ date('Y') }} ProdCat. Tous droits réservés. Développé par <a href="https://me.gasycoder.com/" class="text-gray-900 hover:underline" target="_blank">Florent</a></p>
            </div>
        </div>
    </footer>

    <script>
        function toggleDropdown(id) {
            document.getElementById(id).classList.toggle('hidden');
        }
        
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const icon = document.getElementById('mobile-menu-icon');
            menu.classList.toggle('hidden');
            icon.className = menu.classList.contains('hidden') ? 'i-lucide-menu w-6 h-6' : 'i-lucide-x w-6 h-6';
        }
        
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#categories-dropdown-btn')) {
                document.getElementById('categories-dropdown').classList.add('hidden');
            }
            if (!e.target.closest('#user-dropdown-btn')) {
                document.getElementById('user-dropdown').classList.add('hidden');
            }
        });
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        </script>
    @endif

    @yield('scripts')
</body>
</html>