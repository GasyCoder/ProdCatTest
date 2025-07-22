@props(['product'])

<div class="bg-white rounded-lg border hover:shadow-md transition-shadow">
    <!-- Product Image -->
    <div class="h-32 bg-gray-100 rounded-t-lg flex items-center justify-center">
        @if($product->category->name === 'Smartphones')
            <i class="i-lucide-smartphone w-12 h-12 text-gray-400"></i>
        @elseif($product->category->name === 'Ordinateurs Portables')
            <i class="i-lucide-laptop w-12 h-12 text-gray-400"></i>
        @elseif($product->category->name === 'Accessoires')
            <i class="i-lucide-headphones w-12 h-12 text-gray-400"></i>
        @else
            <i class="i-lucide-package w-12 h-12 text-gray-400"></i>
        @endif
    </div>
    
    <!-- Product Info -->
    <div class="p-3">
        <!-- Name -->
        <h3 class="font-semibold text-gray-900 mb-2 text-sm">
            <a href="{{ route('products.show', $product->slug) }}" class="hover:text-gray-600">
                {{ Str::limit($product->name, 30) }}
            </a>
        </h3>

        <!-- Price and Stock -->
        <div class="flex items-center justify-between mb-2">
            <div class="text-lg font-bold text-gray-900">
                {{ number_format($product->price, 2) }} €
            </div>
            <div class="text-xs text-gray-500">
                Stock: {{ $product->stock_quantity }}
            </div>
        </div>

        <!-- Action Button -->
        <a href="{{ route('products.show', $product->slug) }}" 
           class="w-full bg-gray-900 text-white py-1.5 px-3 rounded text-xs font-medium hover:bg-gray-700 text-center block transition-colors">
            Voir
        </a>
    </div>
</div>