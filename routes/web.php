<?php

use App\Http\Middleware\SubdomainHandler;
use App\Livewire\Pages;
use App\Models\Empresa;
use Illuminate\Support\Facades\Route;

$host = parse_url(config('app.url'), PHP_URL_HOST);

Route::domain("{empresa:slug}.{$host}")->group(function () {

    Route::get('/produtos', Pages\Empresas\Produtos::class)->name('empresa.produtos');
    Route::get('/produto/{produto}', Pages\Empresas\Produto::class)->name('empresa.produto.show');
    // Route::get('/', Pages\Empresas\Home::class)->name('empresa.home');

    Route::get('categorias', Pages\Empresas\Categoria::class);
    Route::get('categoria/{categoria}', Pages\Empresas\Categoria::class);


    Route::view('xxx', 'xxx');

    Route::get('{slug?}', Pages\Empresas\Dinamica::class)->name('empresa.dinamica');
});


Route::domain($host)->get('/', Pages\Home::class)->name('home');

Route::get('/empresa/{empresa}/produtos', Pages\Empresas\Produtos::class)->name('empresa.produtos');
Route::get('/empresa/{empresa}/produto/{produto}', Pages\Empresas\Produto::class)->name('empresa.produto.show');
Route::get('/empresa/{empresa}', Pages\Empresas\Home::class)->name('empresa.home');

Route::get('/empresa/{empresa}/categorias', Pages\Empresas\Categoria::class)->name('empresa.categorias');
Route::get('/empresa/{empresa}/categoria/{categoria}', Pages\Empresas\Categoria::class)->name('empresa.categoria');
