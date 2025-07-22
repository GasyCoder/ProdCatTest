<?php


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Http\Middleware\AdminMiddleware;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->adminUser = User::factory()->create(['type' => 'admin']);
    $this->normalUser = User::factory()->create(['type' => 'user']);
    $this->middleware = new AdminMiddleware();
});

it('permet à un admin de passer', function () {

    $this->actingAs($this->adminUser);
    
    $request = Request::create('/admin/dashboard', 'GET');
    $next = function ($req) {
        return response('Success');
    };

    $response = $this->middleware->handle($request, $next);
    
    expect($response->getContent())->toBe('Success');
});

it('bloque un utilisateur normal', function () {

    $this->actingAs($this->normalUser);
    
    $request = Request::create('/admin/dashboard', 'GET');
    $next = function ($req) {
        return response('Success');
    };


    expect(fn() => $this->middleware->handle($request, $next))
        ->toThrow(\Symfony\Component\HttpKernel\Exception\HttpException::class);
});

it('redirige un utilisateur non connecté vers login', function () {

    $request = Request::create('/admin/dashboard', 'GET');
    $next = function ($req) {
        return response('Success');
    };

    $response = $this->middleware->handle($request, $next);
    
    expect($response->getStatusCode())->toBe(302);
    expect($response->getTargetUrl())->toContain('/login');
});

it('fonctionne avec des routes protégées', function () {

    $response = $this->actingAs($this->adminUser)
        ->get('/admin/test'); 
    
 
    expect($response->getStatusCode())->not->toBe(403);
    

    $response = $this->actingAs($this->normalUser)
        ->get('/admin/test');
    
    expect($response->getStatusCode())->toBe(403);
});