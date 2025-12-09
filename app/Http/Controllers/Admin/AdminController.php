<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\Kamar;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ========== DASHBOARD ==========
    
    public function dashboard()
    {
        $totalKost = Kost::count();
        $totalKamar = Kamar::count();
        $totalBooking = Booking::count();
        $totalUsers = User::where('role', 'user')->count();

        $recentKost = Kost::orderBy('created_at', 'desc')->take(5)->get();
        $recentBooking = Booking::with(['user', 'kamar.kost'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('layouts.admin_dashboard', compact(
            'totalKost',
            'totalKamar',
            'totalBooking',
            'totalUsers',
            'recentKost',
            'recentBooking'
        ));
    }

    // ========== KOST CRUD ==========
    
    public function kost()
    {
        $kosts = Kost::withCount('kamar')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.kost', compact('kosts'));
    }

    public function storeKost(Request $request)
    {
        $request->validate([
            'nama_kost' => 'required|string|max:255',
            'kategori' => 'required|in:putra,putri,campur',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'foto_utama' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('foto_utama');
        
        if ($request->hasFile('foto_utama')) {
            $file = $request->file('foto_utama');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kost'), $filename);
            $data['foto_utama'] = 'uploads/kost/' . $filename;
        }

        Kost::create($data);

        return redirect()->route('admin.kost')->with('success', 'Kost berhasil ditambahkan!');
    }

    public function updateKost(Request $request, $id)
    {
        $kost = Kost::findOrFail($id);

        $request->validate([
            'nama_kost' => 'required|string|max:255',
            'kategori' => 'required|in:putra,putri,campur',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'foto_utama' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('foto_utama');
        
        if ($request->hasFile('foto_utama')) {
            // Delete old photo
            if ($kost->foto_utama && file_exists(public_path($kost->foto_utama))) {
                unlink(public_path($kost->foto_utama));
            }
            
            $file = $request->file('foto_utama');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kost'), $filename);
            $data['foto_utama'] = 'uploads/kost/' . $filename;
        }

        $kost->update($data);

        return redirect()->route('admin.kost')->with('success', 'Kost berhasil diupdate!');
    }

    public function deleteKost($id)
    {
        $kost = Kost::findOrFail($id);
        
        // Delete photo if exists
        if ($kost->foto_utama && file_exists(public_path($kost->foto_utama))) {
            unlink(public_path($kost->foto_utama));
        }
        
        $kost->delete();

        return response()->json(['success' => true, 'message' => 'Kost berhasil dihapus!']);
    }

    public function getKost($id)
    {
        $kost = Kost::findOrFail($id);
        return response()->json($kost);
    }

    // ========== KAMAR CRUD ==========
    
    public function kamar()
    {
        $kamars = Kamar::with('kost')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.kamar', compact('kamars'));
    }

    public function storeKamar(Request $request)
    {
        $request->validate([
            'kost_id' => 'required|exists:kost,id',
            'tipe_kamar' => 'required|string|max:100',
            'harga_bulanan' => 'required|numeric|min:0',
            'jumlah_tersedia' => 'required|integer|min:0',
            'foto_kamar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('foto_kamar');
        
        if ($request->hasFile('foto_kamar')) {
            $file = $request->file('foto_kamar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kamar'), $filename);
            $data['foto_kamar'] = 'uploads/kamar/' . $filename;
        }

        Kamar::create($data);

        return redirect()->route('admin.kamar')->with('success', 'Kamar berhasil ditambahkan!');
    }

    public function updateKamar(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        $request->validate([
            'kost_id' => 'required|exists:kost,id',
            'tipe_kamar' => 'required|string|max:100',
            'harga_bulanan' => 'required|numeric|min:0',
            'jumlah_tersedia' => 'required|integer|min:0',
            'foto_kamar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('foto_kamar');
        
        if ($request->hasFile('foto_kamar')) {
            // Delete old photo
            if ($kamar->foto_kamar && file_exists(public_path($kamar->foto_kamar))) {
                unlink(public_path($kamar->foto_kamar));
            }
            
            $file = $request->file('foto_kamar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kamar'), $filename);
            $data['foto_kamar'] = 'uploads/kamar/' . $filename;
        }

        $kamar->update($data);

        return redirect()->route('admin.kamar')->with('success', 'Kamar berhasil diupdate!');
    }

    public function deleteKamar($id)
    {
        $kamar = Kamar::findOrFail($id);
        
        // Delete photo if exists
        if ($kamar->foto_kamar && file_exists(public_path($kamar->foto_kamar))) {
            unlink(public_path($kamar->foto_kamar));
        }
        
        $kamar->delete();

        return response()->json(['success' => true, 'message' => 'Kamar berhasil dihapus!']);
    }

    public function getKamar($id)
    {
        $kamar = Kamar::with('kost')->findOrFail($id);
        return response()->json($kamar);
    }

    // ========== BOOKING CRUD ==========
    
    public function booking(Request $request)
    {
        $query = Booking::with(['user', 'kamar.kost']);
        
        // Filter by status if provided
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $bookings = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.booking', compact('bookings'));
    }

    public function getBookingDetail($id)
    {
        $booking = Booking::with(['user', 'kamar.kost'])->findOrFail($id);
        return response()->json($booking);
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,aktif,selesai,dibatalkan'
        ]);

        $oldStatus = $booking->status;
        $newStatus = $request->status;
        
        $booking->status = $newStatus;
        $booking->save();

        // Update jumlah kamar tersedia
        $kamar = $booking->kamar;
        
        if ($oldStatus === 'pending' && $newStatus === 'aktif') {
            // Kurangi kamar tersedia
            if ($kamar->jumlah_tersedia > 0) {
                $kamar->jumlah_tersedia -= 1;
                $kamar->save();
            }
        } elseif ($oldStatus === 'aktif' && ($newStatus === 'selesai' || $newStatus === 'dibatalkan')) {
            // Tambah kamar tersedia
            $kamar->jumlah_tersedia += 1;
            $kamar->save();
        }

        return response()->json(['success' => true, 'message' => 'Status booking berhasil diupdate!']);
    }

    public function deleteBooking($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Jika booking aktif, kembalikan kamar tersedia
        if ($booking->status === 'aktif') {
            $kamar = $booking->kamar;
            $kamar->jumlah_tersedia += 1;
            $kamar->save();
        }
        
        $booking->delete();

        return response()->json(['success' => true, 'message' => 'Booking berhasil dihapus!']);
    }

    // ========== USER CRUD ==========
    
    public function users()
    {
        $users = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.users', compact('users'));
    }

    public function getUserDetail($id)
    {
        $user = User::with(['booking.kamar.kost'])->findOrFail($id);
        
        $user->total_booking = $user->booking->count();
        
        return response()->json($user);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        // Delete photo if exists
        if ($user->foto_profil && $user->foto_profil !== 'default-avatar.png') {
            if (file_exists(public_path($user->foto_profil))) {
                unlink(public_path($user->foto_profil));
            }
        }
        
        // Booking akan terhapus otomatis karena CASCADE di database
        $user->delete();

        return response()->json(['success' => true, 'message' => 'User berhasil dihapus!']);
    }
}