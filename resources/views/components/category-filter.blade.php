@props([
    'categories', 
    'currentCategory' => null
])

<div class="mb-8">
    <div class="flex flex-wrap gap-3 justify-center">
        {{-- Bouton "Tous" --}}
        <a href="{{ route('home') }}" 
           class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium border transition-colors {{ is_null($currentCategory) ? 'bg-gray-900 text-white border-gray-900' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
            <i class="i-lucide-grid-3x3 w-4 h-4 mr-2"></i>
            Tous
        </a>

        {{-- Boutons des catégories --}}
        @foreach($categories as $category)
            @php
                $isActive = $currentCategory && $currentCategory->id === $category->id;
            @endphp
            <a href="{{ route('categories.show', $category) }}" 
               class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium border transition-colors {{ $isActive ? 'bg-gray-900 text-white border-gray-900' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                @if($category->name === 'Smartphones')
                    <i class="i-lucide-smartphone w-4 h-4 mr-2"></i>
                @elseif($category->name === 'Ordinateurs Portables')
                    <i class="i-lucide-laptop w-4 h-4 mr-2"></i>
                @elseif($category->name === 'Accessoires')
                    <i class="i-lucide-headphones w-4 h-4 mr-2"></i>
                @else
                    <i class="i-lucide-package w-4 h-4 mr-2"></i>
                @endif
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</div>