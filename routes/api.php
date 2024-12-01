<?php

use App\Http\Controllers\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/validate-token', function (Request $request) {
    try {
        //code...
        return response()->json([
            'status' => true,
            'message' => 'Token is valid',
            'data' => $request->user()
        ], 200);
    } catch (\Throwable $th) {
        //throw $th;
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ]);
    }
})->middleware('auth:sanctum');

Route::post('logout', LogoutController::class)->middleware('auth:sanctum');

Route::post('login', \App\Http\Controllers\LoginController::class);
