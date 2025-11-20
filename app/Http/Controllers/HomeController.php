<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Kost::with(['kamars', 'reviews', 'fasilitas']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_kost', 'like', "%{$search}%")
                  ->orWhere('alamat_kost', 'like', "%{$search}%");
            });
        }

        // Filter by jenis
        if ($request->filled('jenis_kost')) {
            $query->where('jenis_kost', $request->jenis_kost);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->whereHas('kamars', function($q) use ($request) {
                $q->where('harga_kamar', '>=', $request->min_price);
            });
        }

        if ($request->filled('max_price')) {
            $query->whereHas('kamars', function($q) use ($request) {
                $q->where('harga_kamar', '<=', $request->max_price);
            });
        }

        $kosts = $query->paginate(12);

        return view('home', compact('kosts'));
    }
}