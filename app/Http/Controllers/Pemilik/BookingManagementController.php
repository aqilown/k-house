<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingManagementController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['kamar.kost', 'user'])
            ->whereHas('kamar.kost', function($q) {
                $q->where('id_user', auth()->id());
            })
            ->latest()
            ->get();

        return view('pemilik.booking.index', compact('bookings'));
    }

    public function approve($id)
    {
        $booking = Booking::whereHas('kamar.kost', function($q) {
            $q->where('id_user', auth()->id());
        })->findOrFail($id);

        $booking->update(['status_booking' => 'diterima']);
        $booking->kamar->update(['status_kamar' => 'terisi']);

        return back()->with('success', 'Booking berhasil disetujui!');
    }

    public function reject($id)
    {
        $booking = Booking::whereHas('kamar.kost', function($q) {
            $q->where('id_user', auth()->id());
        })->findOrFail($id);

        $booking->update(['status_booking' => 'ditolak']);

        return back()->with('success', 'Booking berhasil ditolak!');
    }
}