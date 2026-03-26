<?php

use App\Models\FeedbackDesa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //$feedback = FeedbackDesa::latest()->get();

    //untuk pagination di welcome.balde.php
    $feedback = FeedbackDesa::latest()->paginate(10);
    return view('welcome', ['feedback' => $feedback]);
});
