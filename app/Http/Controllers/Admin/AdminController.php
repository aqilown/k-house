<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\Kamar;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Dashboard - Tampilan utama admin
     */
    public function dashboard()
    {
        // Hitung total data
        $totalKost = Kost::count();
        $totalKamar = Kamar::count();
        $totalBooking = Booking::count();
        $totalUsers = User::where('role', 'user')->count();

        // Ambil data terbaru untuk ditampilkan
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

    /**
     * Data Kost - Tampilkan semua kost
     */
    public function kost()
    {
        $kosts = Kost::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.kost', compact('kosts'));
    }

    /**
     * Data Kamar - Tampilkan semua kamar
     */
    public function kamar()
    {
        $kamars = Kamar::with('kost')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.kamar', compact('kamars'));
    }

    /**
     * Data Booking - Tampilkan semua booking
     */
    public function booking()
    {
        $bookings = Booking::with(['user', 'kamar.kost'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.booking', compact('bookings'));
    }

    /**
     * Data User - Tampilkan semua user
     */
    public function users()
    {
        $users = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.users', compact('users'));
    }
}