<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the payments.
     */
    public function index()
    {
        $pembayarans = Pembayaran::with(['user', 'booking'])->latest()->paginate(10);
        return view('pembayarans.index', compact('pembayarans'));
    }

    /**
     * Show the form for creating a new payment.
     */
    public function create()
    {
        $users = User::all();
        $bookings = Booking::with(['user', 'talent.user', 'portfolio'])->get();
        return view('pembayarans.create', compact('users', 'bookings'));
    }

    /**
     * Store a newly created payment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_booking' => 'required|exists:booking,id_booking|unique:pembayaran,id_booking',
            'id_user' => 'required|exists:users,id',
            'jumlah_harga' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:cash,qris,gopay',
            'status_pembayaran' => 'required|in:menunggu pembayaran,selesai,batal,menunggu verifikasi',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_pembayaran' => 'required|date',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPath = $request->file('bukti_pembayaran')->store('pembayaran', 'public');
        }

        Pembayaran::create([
            'id_booking' => $request->id_booking,
            'id_user' => $request->id_user,
            'jumlah_harga' => $request->jumlah_harga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
            'bukti_pembayaran' => $buktiPath,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
        ]);

        return redirect()->route('pembayarans.index')
            ->with('success', 'Payment created successfully.');
    }

    /**
     * Display the specified payment.
     */
    public function show(Pembayaran $pembayaran)
    {
        return view('pembayarans.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified payment.
     */
    public function edit(Pembayaran $pembayaran)
    {
        $users = User::all();
        $bookings = Booking::with(['user', 'talent.user', 'portfolio'])->get();
        return view('pembayarans.edit', compact('pembayaran', 'users', 'bookings'));
    }

    /**
     * Update the specified payment in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'id_booking' => 'required|exists:booking,id_booking|unique:pembayaran,id_booking,' . $pembayaran->id_pembayaran . ',id_pembayaran',
            'id_user' => 'required|exists:users,id',
            'jumlah_harga' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:cash,qris,gopay',
            'status_pembayaran' => 'required|in:menunggu pembayaran,selesai,batal,menunggu verifikasi',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_pembayaran' => 'required|date',
        ]);

        $data = [
            'id_booking' => $request->id_booking,
            'id_user' => $request->id_user,
            'jumlah_harga' => $request->jumlah_harga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
        ];

        if ($request->hasFile('bukti_pembayaran')) {
            // Delete old bukti
            if ($pembayaran->bukti_pembayaran) {
                Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
            }
            
            // Store new bukti
            $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('pembayaran', 'public');
        }

        $pembayaran->update($data);

        return redirect()->route('pembayarans.index')
            ->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified payment from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        // Delete bukti
        if ($pembayaran->bukti_pembayaran) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }

        $pembayaran->delete();

        return redirect()->route('pembayarans.index')
            ->with('success', 'Payment deleted successfully.');
    }
}
