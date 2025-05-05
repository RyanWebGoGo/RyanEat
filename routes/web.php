<?php

use Illuminate\Support\Facades\Route;

//=================== RyanEat ===================

//last update : 20250312
Route::get('/ryaneat-index', function () {
    return view('ryaneat-index');
});

Route::get('/ryaneat-index2', function () {
    return view('ryaneat-index2');
});

//=================== RyanEat ===================


Route::view('/', 'home-takeaway')->name('takeaway-home');
Route::view('/cart', 'cart-takeaway')->name('takeaway-cart');
Route::view('/checkout', 'checkout-takeaway')->name('takeaway-checkout');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('categories-admin', 'categories-admin')
    ->middleware(['auth'])
    ->name('category-crud');

Route::view('items-admin', 'items-admin')
    ->middleware(['auth'])
    ->name('item-crud');

Route::view('itemimages-admin', 'itemimages-admin')
    ->middleware(['auth'])
    ->name('item-images-crud');

require __DIR__.'/auth.php';


