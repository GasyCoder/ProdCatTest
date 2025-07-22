<?php


use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->category = Category::factory()->create(['name' => 'Smartphones']);
});

it('peut créer un produit', function () {
    $product = Product::create([
        'name' => 'iPhone 15 Pro',
        'description' => 'Dernier iPhone',
        'price' => 1199.99,
        'stock_quantity' => 25,
        'category_id' => $this->category->id
    ]);

    expect($product)
        ->toBeInstanceOf(Product::class)
        ->and($product->name)->toBe('iPhone 15 Pro')
        ->and($product->slug)->toBe('iphone-15-pro')
        ->and($product->price)->toBe(1199.99); 
});

it('génère automatiquement un slug unique', function () {

    $product1 = Product::create([
        'name' => 'iPhone 15',
        'description' => 'Test',
        'price' => 999.99,
        'stock_quantity' => 10,
        'category_id' => $this->category->id
    ]);
    expect($product1->slug)->toBe('iphone-15');


    $product2 = Product::create([
        'name' => 'iPhone 15',
        'description' => 'Test',
        'price' => 999.99,
        'stock_quantity' => 10,
        'category_id' => $this->category->id
    ]);
    

    expect($product2->slug)
        ->toStartWith('iphone-15-')
        ->and($product2->slug)->not->toBe('iphone-15');
});

it('appartient à une catégorie', function () {
    $product = Product::factory()->create(['category_id' => $this->category->id]);

    expect($product->category)
        ->toBeInstanceOf(Category::class)
        ->and($product->category->id)->toBe($this->category->id);
});

it('formate le prix correctement', function () {
    $product = Product::factory()->create([
        'price' => 1199.99,
        'category_id' => $this->category->id
    ]);

    expect($product->formatted_price)->toBe('1,199.99 €');
});

it('cast le prix en float', function () {
    $product = Product::create([
        'name' => 'Test Product',
        'description' => 'Test',
        'price' => '999.99',
        'stock_quantity' => 10,
        'category_id' => $this->category->id
    ]);


    expect($product->price)->toBeFloat();
    expect($product->price)->toBe(999.99);
});