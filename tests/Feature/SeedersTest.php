<?php


use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('CategorySeeder crée 3 catégories', function () {
    expect(Category::count())->toBe(0);

    $this->seed(CategorySeeder::class);

    expect(Category::count())->toBe(3);
    
    $categoryNames = Category::pluck('name')->toArray();
    expect($categoryNames)->toContain('Smartphones', 'Ordinateurs Portables', 'Accessoires');
});

it('ProductSeeder crée 4 produits', function () {
    $this->seed(CategorySeeder::class);
    expect(Product::count())->toBe(0);

    $this->seed(ProductSeeder::class);

    expect(Product::count())->toBe(4);
});

it('UserSeeder crée un admin et un utilisateur', function () {
    expect(User::count())->toBe(0);

    $this->seed(UserSeeder::class);

    expect(User::count())->toBe(2);
    expect(User::where('type', 'admin')->count())->toBe(1);
    expect(User::where('type', 'user')->count())->toBe(1);
});

it('tous les produits ont une catégorie valide après seeding', function () {
    $this->seed([CategorySeeder::class, ProductSeeder::class]);

    $products = Product::all();
    
    foreach ($products as $product) {
        expect($product->category)->toBeInstanceOf(Category::class);
    }
});