<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Booking;
use App\Models\User;
use App\Models\Talent;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the ratings.
     */
    public function index()
    {
        $ratings = Rating::with(['user', 'talent.user', 'booking'])->latest()->paginate(10);
        return view('ratings.index', compact('ratings'));
    }

    /**
     * Show the form for creating a new rating.
     */
    public function create()
    {
        $users = User::all();
        $talents = Talent::with('user')->get();
        $bookings = Booking::with(['user', 'talent.user', 'portfolio'])->get();
        return view('ratings.create', compact('users', 'talents', 'bookings'));
    }

    /**
     * Store a newly created rating in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_booking' => 'required|exists:booking,id_booking|unique:rating,id_booking',
            'id_user' => 'required|exists:users,id',
            'id_talenta' => 'required|exists:talenta,id_talenta',
            'score_rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:255',
        ]);

        Rating::create([
            'id_booking' => $request->id_booking,
            'id_user' => $request->id_user,
            'id_talenta' => $request->id_talenta,
            'score_rating' => $request->score_rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('ratings.index')
            ->with('success', 'Rating created successfully.');
    }

    /**
     * Display the specified rating.
     */
    public function show(Rating $rating)
    {
        return view('ratings.show', compact('rating'));
    }

    /**
     * Show the form for editing the specified rating.
     */
    public function edit(Rating $rating)
    {
        $users = User::all();
        $talents = Talent::with('user')->get();
        $bookings = Booking::with(['user', 'talent.user', 'portfolio'])->get();
        return view('ratings.edit', compact('rating', 'users', 'talents', 'bookings'));
    }

    /**
     * Update the specified rating in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        $request->validate([
            'id_booking' => 'required|exists:booking,id_booking|unique:rating,id_booking,' . $rating->id_rating . ',id_rating',
            'id_user' => 'required|exists:users,id',
            'id_talenta' => 'required|exists:talenta,id_talenta',
            'score_rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:255',
        ]);

        $rating->update([
            'id_booking' => $request->id_booking,
            'id_user' => $request->id_user,
            'id_talenta' => $request->id_talenta,
            'score_rating' => $request->score_rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('ratings.index')
            ->with('success', 'Rating updated successfully.');
    }

    /**
     * Remove the specified rating from storage.
     */
    public function destroy(Rating $rating)
    {
        $rating->delete();

        return redirect()->route('ratings.index')
            ->with('success', 'Rating deleted successfully.');
    }
}
