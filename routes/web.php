<?php

use App\Livewire\Pages;
use Illuminate\Support\Facades\Route;

Route::get('/', Pages\Home::class)->name('home');

Route::get('/empresa/{empresa}/produtos', Pages\Empresas\Produtos::class)->name('empresa.produtos');
Route::get('/empresa/{empresa}', Pages\Empresas\Home::class)->name('empresa.home');
