<?php

namespace App\Http\Controllers;

use App\Models\FeedbackDesa;
use Illuminate\Http\Request;

class FeedbackDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FeedbackDesa $feedbackDesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeedbackDesa $feedbackDesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeedbackDesa $feedbackDesa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeedbackDesa $feedbackDesa)
    {
        //
    }
    public function pagination()
    {
        return FeedbackDesa::latest()->simplePaginate(10);
    }
}
