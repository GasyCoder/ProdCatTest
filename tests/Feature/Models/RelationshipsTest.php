<?php


use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('une catégorie peut avoir plusieurs produits', function () {
    $category = Category::factory()->create();
    $products = Product::factory()->count(5)->create(['category_id' => $category->id]);

    expect($category->products)
        ->toHaveCount(5)
        ->and($category->products->pluck('id')->toArray())
        ->toEqual($products->pluck('id')->toArray());
});

it('un produit appartient à une seule catégorie', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    expect($product->category)
        ->toBeInstanceOf(Category::class)
        ->and($product->category->id)->toBe($category->id);
});

it('supprimer une catégorie supprime ses produits (cascade)', function () {
    $category = Category::factory()->create();
    $products = Product::factory()->count(3)->create(['category_id' => $category->id]);

    expect(Product::count())->toBe(3);

    $category->delete();

    expect(Product::count())->toBe(0);
});