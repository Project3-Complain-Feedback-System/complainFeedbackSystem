<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            //code...
            $request->validate([
                'nik' => 'required|numeric|min:16',
                'tanggal_lahir' => 'required|date'
            ]);
            $penduduk = Penduduk::where('nik', '=', $request->nik)->firstOrFail();
            if (!$penduduk || $penduduk->tanggal_lahir !== $request->tanggal_lahir) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data yang anda masukkan salah, login gagal'
                ], 400);
            }

            return response()->json([
                'status' => true,
                'message' => 'Login berhasil',
                'token' => $penduduk->createToken('login penduduk')->plainTextToken,
                'userInfo' => $penduduk
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
