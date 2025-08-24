<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $kategoris = Kategori::latest()->paginate(10);
        return view('kategoris.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('kategoris.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori',
            'deskripsi' => 'required|string|max:1000',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategoris.index')
            ->with('success', 'Kategori created successfully.');
    }

    /**
     * Display the specified category.
     */
    public function show(Kategori $kategori)
    {
        return view('kategoris.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Kategori $kategori)
    {
        return view('kategoris.edit', compact('kategori'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori,' . $kategori->id_kategori . ',id_kategori',
            'deskripsi' => 'required|string|max:1000',
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategoris.index')
            ->with('success', 'Kategori updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategoris.index')
            ->with('success', 'Kategori deleted successfully.');
    }
}
