<?php

use App\Livewire\Pages;
use Illuminate\Support\Facades\Route;

Route::get('/', Pages\Home::class)->name('home');
Route::get('/produtos', Pages\Produtos::class)->name('produtos');
