<?php

use App\Livewire\Pages;
use App\Models\Empresa;
use Illuminate\Support\Facades\Route;

$host = parse_url(config('app.url'), PHP_URL_HOST);

Route::domain("{empresa:nome}.{$host}")->group(static function () {

    Route::get('/produtos', Pages\Empresas\Produtos::class)->name('empresa.produtos');
    Route::get('/produto/{produto}', Pages\Empresas\Produto::class)->name('empresa.produto.show');
    Route::get('/', Pages\Empresas\Home::class)->name('empresa.home');
});


Route::domain($host)->get('/', Pages\Home::class)->name('home');

Route::get('/empresa/{empresa}/produtos', Pages\Empresas\Produtos::class)->name('empresa.produtos');
Route::get('/empresa/{empresa}/produto/{produto}', Pages\Empresas\Produto::class)->name('empresa.produto.show');
Route::get('/empresa/{empresa}', Pages\Empresas\Home::class)->name('empresa.home');

Route::get('/empresa/{empresa}/categorias', Pages\Empresas\Categoria::class)->name('empresa.categorias');
Route::get('/empresa/{empresa}/categoria/{categoria}', Pages\Empresas\Categoria::class)->name('empresa.categoria');
