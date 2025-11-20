<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['kamar.kost'])
            ->where('id_user', auth()->id())
            ->latest()
            ->get();

        return view('user.dashboard', compact('bookings'));
    }
}