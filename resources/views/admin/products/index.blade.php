@extends('layouts.app')

@section('title', 'Liste des produits')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
     <x-breadcrumb :items="[
        ['label' => 'Produits', 'url' => route('admin.produits.index')]
    ]" />

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Liste des produits ({{ $products->total() }})</h1>
        <a href="{{ route('admin.produits.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-700">
            <i class="i-lucide-plus w-4 h-4 mr-2"></i> Ajouter un produit
        </a>
    </div>


    <div class="bg-white rounded-lg border">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($product->name, 30) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->formatted_price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap {{ $product->stock_quantity <= 10 ? 'text-yellow-600' : '' }}">
                            {{ $product->stock_quantity }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <a href="{{ route('admin.produits.edit', $product) }}"
                            class="text-blue-600 hover:text-blue-900 mr-4">
                                <i class="i-lucide-edit w-4 h-4"></i>
                            </a>
                            <button type="button" onclick="confirmDelete('{{ route('admin.produits.destroy', $product) }}')"
                                    class="text-red-600 hover:text-red-900">
                                <i class="i-lucide-trash w-4 h-4"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-600">Aucun produit trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function confirmDelete(url) {
        Swal.fire({
            title: 'Voulez-vous vraiment supprimer ce produit ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endsection