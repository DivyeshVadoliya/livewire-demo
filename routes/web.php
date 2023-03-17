<?php

use App\Http\Livewire\HelloWorld;
use App\Http\Livewire\ProductList;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', HelloWorld::class);

Route::get('/list', ProductList::class);
