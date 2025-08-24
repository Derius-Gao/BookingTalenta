<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Talent;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the bookings.
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'talent.user', 'portfolio'])->latest()->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create()
    {
        $users = User::all();
        $talents = Talent::with('user')->get();
        $portfolios = Portfolio::with(['talent.user', 'kategori'])->get();
        return view('bookings.create', compact('users', 'talents', 'portfolios'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_talenta' => 'required|exists:talenta,id_talenta',
            'id_portfolio' => 'required|exists:portfolio,id_portfolio',
            'deskripsi_acara' => 'required|string|max:255',
            'lokasi_acara' => 'required|string|max:255',
            'jumlah_harga' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
        ]);

        Booking::create([
            'id_user' => $request->id_user,
            'id_talenta' => $request->id_talenta,
            'id_portfolio' => $request->id_portfolio,
            'deskripsi_acara' => $request->deskripsi_acara,
            'lokasi_acara' => $request->lokasi_acara,
            'jumlah_harga' => $request->jumlah_harga,
            'status' => $request->status,
        ]);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified booking.
     */
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified booking.
     */
    public function edit(Booking $booking)
    {
        $users = User::all();
        $talents = Talent::with('user')->get();
        $portfolios = Portfolio::with(['talent.user', 'kategori'])->get();
        return view('bookings.edit', compact('booking', 'users', 'talents', 'portfolios'));
    }

    /**
     * Update the specified booking in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_talenta' => 'required|exists:talenta,id_talenta',
            'id_portfolio' => 'required|exists:portfolio,id_portfolio',
            'deskripsi_acara' => 'required|string|max:255',
            'lokasi_acara' => 'required|string|max:255',
            'jumlah_harga' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
        ]);

        $booking->update([
            'id_user' => $request->id_user,
            'id_talenta' => $request->id_talenta,
            'id_portfolio' => $request->id_portfolio,
            'deskripsi_acara' => $request->deskripsi_acara,
            'lokasi_acara' => $request->lokasi_acara,
            'jumlah_harga' => $request->jumlah_harga,
            'status' => $request->status,
        ]);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }
}
