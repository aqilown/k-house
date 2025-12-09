<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost;
use App\Models\Kamar;

class HomeController extends Controller
{
    /**
     * Halaman Home - Tampil kost terbaru
     */
    public function index()
    {
        // Ambil 6 kost terbaru dengan kamar
        $kosts = Kost::with(['kamar', 'fasilitas'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('home', compact('kosts'));
    }

    /**
     * Halaman Cari Kost - Filter & search
     */
    public function cariKost(Request $request)
    {
        $query = Kost::with(['kamar', 'fasilitas']);

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Search berdasarkan lokasi
        if ($request->has('lokasi') && $request->lokasi != '') {
            $lokasi = $request->lokasi;
            $query->where(function($q) use ($lokasi) {
                $q->where('nama_kost', 'like', "%{$lokasi}%")
                  ->orWhere('kota', 'like', "%{$lokasi}%")
                  ->orWhere('kecamatan', 'like', "%{$lokasi}%")
                  ->orWhere('alamat', 'like', "%{$lokasi}%");
            });
        }

        $kosts = $query->paginate(9);

        return view('cari-kost', compact('kosts'));
    }

    /**
     * Halaman Detail Kost
     */
    public function detailKost($id)
    {
        $kost = Kost::with(['kamar', 'fasilitas', 'review.user'])
            ->findOrFail($id);

        // Hitung rata-rata rating dari review
        $avgRating = $kost->review->avg('rating') ?? 0;
        $totalReview = $kost->review->count();

        return view('detail-kost', compact('kost', 'avgRating', 'totalReview'));
    }
}