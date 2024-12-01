<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        try {
            //code...
            // return $request->user()->id;
            $request->validate([
                'kategori_id' => 'required|numeric',
                'rating' => 'required|numeric',
                'komentar' => 'required',
                'gambar' => 'image|mimes:png,jpg'
            ]);

            $validated = [
                'penduduk_id' => $request->user()->id,
                'kategori_id' => $request->kategori_id,
                'rating' => $request->rating,
                'komentar' => $request->komentar,
            ];
            if ($request->hasFile('gambar')) {
                $validated['gambar'] = $request->file('gambar')->store('feedbackImages');
            }

            $feedback = \App\Models\Feedback::create($validated);
            if ($feedback) {
                return response()->json([
                    'status' => true,
                    'message' => 'Feedback berhasil dikirim',
                    'data' => $feedback
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Feedback gagal dikirim'
                ], 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }
}
