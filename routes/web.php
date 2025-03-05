<?php

use App\Http\Middleware\SubdomainHandler;
use App\Livewire\Pages;
use App\Models\Empresa;
use App\Services\Workspace;
use Illuminate\Support\Facades\Route;

$workspace = app(Workspace::class);

Route::domain("{empresa:slug}.{$workspace->host}")->group(function () {

    Route::get('/produtos', Pages\Empresas\Produtos::class)->name('empresa.produtos');
    Route::get('/produto/{produto_id}', Pages\Empresas\Produto::class)->name('empresa.produto.show');
    // Route::get('/home', Pages\Empresas\Home::class)->name('empresa.home');

    Route::get('categorias', Pages\Empresas\Categoria::class)->name('empresa.categorias');
    Route::get('categoria/{categoria}', Pages\Empresas\Categoria::class)->name('empresa.categoria');

    Route::get('{slug?}', Pages\Empresas\Dinamica::class)->name('empresa.dinamica');
});


Route::domain($workspace->host)->get('/', Pages\Home::class)->name('home');
