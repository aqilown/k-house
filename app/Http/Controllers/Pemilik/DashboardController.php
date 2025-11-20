<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $totalKosts = Kost::where('id_user', $user->id_user)->count();
        $totalKamars = Kost::where('id_user', $user->id_user)
            ->withCount('kamars')
            ->get()
            ->sum('kamars_count');
        
        $pendingBookings = Booking::whereHas('kamar.kost', function($q) use ($user) {
            $q->where('id_user', $user->id_user);
        })->where('status_booking', 'pending')->count();

        $recentBookings = Booking::with(['kamar.kost', 'user'])
            ->whereHas('kamar.kost', function($q) use ($user) {
                $q->where('id_user', $user->id_user);
            })
            ->latest()
            ->take(5)
            ->get();

        return view('pemilik.dashboard', compact('totalKosts', 'totalKamars', 'pendingBookings', 'recentBookings'));
    }
}