<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        try {
            $categories = Kategori::all();
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Berhasil mendapatkan kategori',
                    'data' => $categories
                ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data kategori: ' . $e->getMessage()], 500);
        }
    }
}
