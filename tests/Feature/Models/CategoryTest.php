<?php


use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('peut créer une catégorie', function () {
    $category = Category::create([
        'name' => 'Test Category',
    ]);

    expect($category)
        ->toBeInstanceOf(Category::class)
        ->and($category->name)->toBe('Test Category')
        ->and($category->slug)->toBe('test-category');
});

it('génère automatiquement un slug unique', function () {

    $category1 = Category::create(['name' => 'Smartphones']);
    expect($category1->slug)->toBe('smartphones');


    $category2 = Category::create(['name' => 'Smartphones']);
    expect($category2->slug)->toBe('smartphones-1');


    $category3 = Category::create(['name' => 'Smartphones']);
    expect($category3->slug)->toBe('smartphones-2');
});

it('génère un slug à partir du nom avec caractères spéciaux', function () {
    $category = Category::create(['name' => 'Téléphones & Accessoires']);
    
    expect($category->slug)->toBe('telephones-accessoires');
});

it('a une relation avec les produits', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    expect($category->products)
        ->toHaveCount(1)
        ->and($category->products->first()->id)->toBe($product->id);
});

it('peut avoir plusieurs produits', function () {
    $category = Category::factory()->create();
    $products = Product::factory()->count(3)->create(['category_id' => $category->id]);

    expect($category->products)->toHaveCount(3);
});