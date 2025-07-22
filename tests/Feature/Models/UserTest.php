<?php


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create([
        'type' => 'admin',
        'email' => 'admin@test.com'
    ]);
    
    $this->user = User::factory()->create([
        'type' => 'user',
        'email' => 'user@test.com'
    ]);
});

it('peut créer un utilisateur admin', function () {
    expect($this->admin)
        ->toBeInstanceOf(User::class)
        ->and($this->admin->type)->toBe('admin')
        ->and($this->admin->isAdmin())->toBeTrue()
        ->and($this->admin->isUser())->toBeFalse();
});

it('peut créer un utilisateur normal', function () {
    expect($this->user)
        ->toBeInstanceOf(User::class)
        ->and($this->user->type)->toBe('user')
        ->and($this->user->isUser())->toBeTrue()
        ->and($this->user->isAdmin())->toBeFalse();
});

it('a un type par défaut utilisateur', function () {

    $user = User::factory()->create([
        'email' => 'default@test.com'
    ]);
    

    expect($user->type)->toBe('user');
});

it('peut vérifier si un utilisateur est admin', function () {
    expect($this->admin->isAdmin())->toBeTrue();
    expect($this->user->isAdmin())->toBeFalse();
});

it('peut vérifier si un utilisateur est utilisateur normal', function () {
    expect($this->user->isUser())->toBeTrue();
    expect($this->admin->isUser())->toBeFalse();
});