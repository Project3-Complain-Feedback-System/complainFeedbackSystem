<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
    // return view('welcome');
});

// Route::get('/', function () {
//     return redirect('/penduduk/login');
// })->name('login');

// Route::get('/penduduk', function () {
//     dd(auth()->user());

//     return 'hai';
//     // return view('welcome');
// })->middleware('auth:penduduk');
