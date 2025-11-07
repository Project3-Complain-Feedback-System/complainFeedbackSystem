<?php

use App\Models\FeedbackDesa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $feedback = FeedbackDesa::all();
    return view('welcome', ['feedback' => $feedback]);
});

// Route::get('/', function () {
//     return redirect('/penduduk/login');
// })->name('login');

// Route::get('/penduduk', function () {
//     dd(auth()->user());

//     return 'hai';
//     // return view('welcome');
// })->middleware('auth:penduduk');
