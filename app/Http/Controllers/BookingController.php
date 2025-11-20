<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_kamar' => 'required|exists:kamars,id_kamar',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'durasi_booking' => 'required|integer|min:1',
        ]);

        $kamar = Kamar::findOrFail($request->id_kamar);

        if (!$kamar->isAvailable()) {
            return back()->with('error', 'Kamar tidak tersedia!');
        }

        $tanggalMulai = Carbon::parse($request->tanggal_mulai);
        $tanggalSelesai = $tanggalMulai->copy()->addMonths($request->durasi_booking);
        $totalHarga = $kamar->harga_kamar * $request->durasi_booking;

        Booking::create([
            'id_user' => auth()->id(),
            'id_kamar' => $request->id_kamar,
            'tanggal_booking' => now(),
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'durasi_booking' => $request->durasi_booking,
            'total_harga' => $totalHarga,
            'status_booking' => 'pending',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Booking berhasil dibuat!');
    }

    public function uploadPayment(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|max:2048',
        ]);

        $booking = Booking::findOrFail($id);

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/payments'), $filename);

            $booking->update(['bukti_pembayaran' => $filename]);
        }

        return back()->with('success', 'Bukti pembayaran berhasil diupload!');
    }
}