@props(['items' => []])

<nav class="flex mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                <i class="i-lucide-home w-4 h-4 mr-2"></i>
                Tableau de bord
            </a>
        </li>
        @foreach ($items as $item)
            <li class="inline-flex items-center">
                <i class="i-lucide-chevron-right w-4 h-4 text-gray-400"></i>
                @if ($item['url'] ?? false)
                    <a href="{{ $item['url'] }}"
                       class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">
                        {{ $item['label'] }}
                    </span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>