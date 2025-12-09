<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Kost;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store review baru
     */
    public function store(Request $request)
    {
        // Validasi user harus login
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Anda harus login terlebih dahulu!');
        }

        // Validasi input
        $request->validate([
            'kost_id' => 'required|exists:kost,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:1000'
        ], [
            'rating.required' => 'Rating harus diisi!',
            'rating.min' => 'Rating minimal 1 bintang',
            'rating.max' => 'Rating maksimal 5 bintang',
            'komentar.required' => 'Komentar harus diisi!',
            'komentar.max' => 'Komentar maksimal 1000 karakter'
        ]);

        // Cek apakah user sudah pernah review kost ini
        $existingReview = Review::where('kost_id', $request->kost_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Anda sudah memberikan review untuk kost ini!');
        }

        // Simpan review
        Review::create([
            'kost_id' => $request->kost_id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'komentar' => $request->komentar
        ]);

        // Update rating kost
        $this->updateKostRating($request->kost_id);

        return redirect()->back()->with('success', 'Review berhasil ditambahkan! Terima kasih atas feedback Anda.');
    }

    /**
     * Update rating kost berdasarkan semua review
     */
    private function updateKostRating($kostId)
    {
        $kost = Kost::findOrFail($kostId);
        
        $reviews = Review::where('kost_id', $kostId)->get();
        $totalReviews = $reviews->count();
        $avgRating = $reviews->avg('rating');

        $kost->update([
            'rating' => round($avgRating, 1),
            'jumlah_review' => $totalReviews
        ]);
    }

    /**
     * Delete review (opsional - untuk nanti)
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Cek apakah user yang menghapus adalah pemilik review
        if ($review->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak berhak menghapus review ini!');
        }

        $kostId = $review->kost_id;
        $review->delete();

        // Update rating kost setelah hapus review
        $this->updateKostRating($kostId);

        return redirect()->back()->with('success', 'Review berhasil dihapus!');
    }
}