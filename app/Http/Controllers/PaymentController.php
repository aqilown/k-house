<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Kost;
use App\Models\Kamar;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Simpan data booking ke session
     */
    public function prepareBooking(Request $request)
    {
        // Validasi input
        $request->validate([
            'kost_id' => 'required|exists:kost,id',
            'kamar_id' => 'required|exists:kamar,id'
        ]);

        // Ambil data kost dan kamar
        $kost = Kost::findOrFail($request->kost_id);
        $kamar = Kamar::findOrFail($request->kamar_id);

        // Simpan data ke session
        session([
            'booking_data' => [
                'kost_id' => $kost->id,
                'kost_nama' => $kost->nama_kost,
                'kamar_id' => $kamar->id,
                'kamar_tipe' => $kamar->tipe_kamar,
                'kamar_ukuran' => $kamar->ukuran,
                'harga_bulanan' => $kamar->harga_bulanan,
                'jumlah_tersedia' => $kamar->jumlah_tersedia,
            ]
        ]);

        // Redirect ke halaman payment
        return redirect()->route('payment');
    }

    public function index()
    {
        // Cek apakah ada data booking di session
        if (!session()->has('booking_data')) {
            return redirect()->route('cari-kost')
                ->with('error', 'Silakan pilih kamar terlebih dahulu.');
        }

        // Ambil data dari session
        $bookingData = session('booking_data');

        // Hitung PPN (12%)
        $ppn = 12;
        $jumlahPembayaran = $bookingData['harga_bulanan'];
        $jumlahPesanan = $bookingData['harga_bulanan'];
        $totalPembayaran = $jumlahPembayaran + ($jumlahPembayaran * $ppn / 100);

        $user = Auth::user();

        // Kirim data ke view
        return view('payment', [
            'user' => $user,
            'bookingData' => $bookingData,
            'jumlahPembayaran' => $jumlahPembayaran,
            'jumlahPesanan' => $jumlahPesanan,
            'ppn' => $ppn,
            'totalPembayaran' => $totalPembayaran,
        ]);
    }

    public function show($orderId)
    {
        $order = Order::findOrFail($orderId);
        $user = Auth::user();

        // Pastikan user berhak akses order ini
        if ($order->user_id !== $user->id) {
            abort(403);
        }

        return view('payment', compact('order', 'user'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'card_number' => 'required|string|size:19', // Format: 1234 5678 9012 3456
            'cvv' => 'required|string|size:3',
            'expiry' => 'required|string|size:7', // Format: MM / YY
        ]);

        // Hapus format untuk validasi lebih lanjut
        $cardNumber = str_replace(' ', '', $validated['card_number']);
        $expiry = str_replace([' ', '/'], '', $validated['expiry']);

        // Validasi Luhn Algorithm untuk card number
        if (!$this->validateLuhn($cardNumber)) {
            return back()->withErrors(['card_number' => 'Nomor kartu tidak valid'])->withInput();
        }

        // Validasi expiry date
        $month = substr($expiry, 0, 2);
        $year = '20' . substr($expiry, 2, 2);

        if ($month < 1 || $month > 12) {
            return back()->withErrors(['expiry' => 'Bulan tidak valid'])->withInput();
        }

        $expiryDate = \Carbon\Carbon::createFromDate($year, $month, 1)->endOfMonth();
        if ($expiryDate->isPast()) {
            return back()->withErrors(['expiry' => 'Kartu sudah kadaluarsa'])->withInput();
        }

        // Process payment here
        // Integrate dengan payment gateway (Stripe, PayPal, Midtrans, dll)

        try {
            // Contoh: Update order status
            $order = Order::findOrFail($request->order_id);
            $order->status = 'paid';
            $order->payment_method = 'credit_card';
            $order->paid_at = now();
            $order->save();

            return redirect()->route('payment.success', $order->id)
                ->with('success', 'Pembayaran berhasil!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memproses pembayaran'])
                ->withInput();
        }
    }

    /**
     * Validasi card number menggunakan Luhn Algorithm
     */
    private function validateLuhn($cardNumber)
    {
        $sum = 0;
        $numDigits = strlen($cardNumber);
        $parity = $numDigits % 2;

        for ($i = 0; $i < $numDigits; $i++) {
            $digit = intval($cardNumber[$i]);

            if ($i % 2 == $parity) {
                $digit *= 2;
            }

            if ($digit > 9) {
                $digit -= 9;
            }

            $sum += $digit;
        }

        return ($sum % 10) == 0;
    }

    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('payment.success', compact('order'));
    }
}
