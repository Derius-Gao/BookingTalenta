<?php

namespace App\Http\Controllers;

use App\Models\Talent;
use App\Models\User;
use Illuminate\Http\Request;

class TalentController extends Controller
{
    /**
     * Display a listing of the talents.
     */
    public function index()
    {
        $talents = Talent::with('user')->latest()->paginate(10);
        return view('talents.index', compact('talents'));
    }

    /**
     * Show the form for creating a new talent.
     */
    public function create()
    {
        $users = User::whereDoesntHave('talent')->get();
        return view('talents.create', compact('users'));
    }

    /**
     * Store a newly created talent in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:talenta,user_id',
            'no_hp' => 'required|string|max:15',
            'spesialisasi' => 'required|string|max:255',
        ]);

        Talent::create([
            'user_id' => $request->user_id,
            'no_hp' => $request->no_hp,
            'spesialisasi' => $request->spesialisasi,
        ]);

        return redirect()->route('talents.index')
            ->with('success', 'Talent created successfully.');
    }

    /**
     * Display the specified talent.
     */
    public function show(Talent $talent)
    {
        return view('talents.show', compact('talent'));
    }

    /**
     * Show the form for editing the specified talent.
     */
    public function edit(Talent $talent)
    {
        $users = User::all();
        return view('talents.edit', compact('talent', 'users'));
    }

    /**
     * Update the specified talent in storage.
     */
    public function update(Request $request, Talent $talent)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:talenta,user_id,' . $talent->id_talenta . ',id_talenta',
            'no_hp' => 'required|string|max:15',
            'spesialisasi' => 'required|string|max:255',
        ]);

        $talent->update([
            'user_id' => $request->user_id,
            'no_hp' => $request->no_hp,
            'spesialisasi' => $request->spesialisasi,
        ]);

        return redirect()->route('talents.index')
            ->with('success', 'Talent updated successfully.');
    }

    /**
     * Remove the specified talent from storage.
     */
    public function destroy(Talent $talent)
    {
        $talent->delete();

        return redirect()->route('talents.index')
            ->with('success', 'Talent deleted successfully.');
    }
}
