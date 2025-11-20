<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Review;
use Illuminate\Http\Request;

class KostController extends Controller
{
    public function show($id)
    {
        $kost = Kost::with(['kamars', 'fasilitas', 'reviews.user', 'user'])
            ->findOrFail($id);

        return view('kost.show', compact('kost'));
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
        ]);

        Review::create([
            'id_kost' => $id,
            'id_user' => auth()->id(),
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success', 'Review berhasil ditambahkan!');
    }
}