<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Talent;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the portfolios.
     */
    public function index()
    {
        $portfolios = Portfolio::with(['talent.user', 'kategori'])->latest()->paginate(10);
        return view('portfolios.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new portfolio.
     */
    public function create()
    {
        $talents = Talent::with('user')->get();
        $kategoris = Kategori::all();
        return view('portfolios.create', compact('talents', 'kategoris'));
    }

    /**
     * Store a newly created portfolio in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_talenta' => 'required|exists:talenta,id_talenta',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga_minimal' => 'required|numeric|min:0',
            'harga_maximal' => 'required|numeric|min:0|gte:harga_minimal',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('portfolios', 'public');
        }

        Portfolio::create([
            'id_talenta' => $request->id_talenta,
            'id_kategori' => $request->id_kategori,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'harga_minimal' => $request->harga_minimal,
            'harga_maximal' => $request->harga_maximal,
        ]);

        return redirect()->route('portfolios.index')
            ->with('success', 'Portfolio created successfully.');
    }

    /**
     * Display the specified portfolio.
     */
    public function show(Portfolio $portfolio)
    {
        return view('portfolios.show', compact('portfolio'));
    }

    /**
     * Show the form for editing the specified portfolio.
     */
    public function edit(Portfolio $portfolio)
    {
        $talents = Talent::with('user')->get();
        $kategoris = Kategori::all();
        return view('portfolios.edit', compact('portfolio', 'talents', 'kategoris'));
    }

    /**
     * Update the specified portfolio in storage.
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'id_talenta' => 'required|exists:talenta,id_talenta',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga_minimal' => 'required|numeric|min:0',
            'harga_maximal' => 'required|numeric|min:0|gte:harga_minimal',
        ]);

        $data = [
            'id_talenta' => $request->id_talenta,
            'id_kategori' => $request->id_kategori,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'harga_minimal' => $request->harga_minimal,
            'harga_maximal' => $request->harga_maximal,
        ];

        if ($request->hasFile('foto')) {
            // Delete old foto
            if ($portfolio->foto) {
                Storage::disk('public')->delete($portfolio->foto);
            }
            
            // Store new foto
            $data['foto'] = $request->file('foto')->store('portfolios', 'public');
        }

        $portfolio->update($data);

        return redirect()->route('portfolios.index')
            ->with('success', 'Portfolio updated successfully.');
    }

    /**
     * Remove the specified portfolio from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        // Delete foto
        if ($portfolio->foto) {
            Storage::disk('public')->delete($portfolio->foto);
        }

        $portfolio->delete();

        return redirect()->route('portfolios.index')
            ->with('success', 'Portfolio deleted successfully.');
    }
}
