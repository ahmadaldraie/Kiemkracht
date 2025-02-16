<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;
use App\Models\Klant;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class KlantController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(['auth', AdminMiddleware::class]),
        ];
    }

    public function index(Request $request)
    {
        $zoekterm = $request->input('query');
        $klanten = Klant::when($zoekterm, function ($query, $zoekterm) {
            $query->where('voornaam', 'like', "%$zoekterm%")
            ->orWhere('achternaam', 'like', "%$zoekterm%")
            ->orWhere('email', 'like', "%$zoekterm%");
        })->get();
        return view('klant.klanten', compact('klanten'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $klant = Klant::findOrFail($id);

        return view('klant.edit_form', compact('klant'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'voornaam'    => 'required|string|max:255|min:1',
            'achternaam'  => 'required|string|max:255|min:1',
            'email'       => 'required|email',
        ]);

        $klant = Klant::findOrFail($id);

        $klant->update($validated);

        return redirect()->route('klanten.index')->with('success', 'Klant met de naam ' . $klant->voornaam . ' ' . $klant->achternaam . ' is gewijzigd!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $klant = Klant::findOrFail($id);
        $kassatickets = $klant->kassatickets;
        if (count($kassatickets)) {
            foreach ($kassatickets as $kassaticket) {
                Storage::disk('public')->delete($kassaticket->bestaand);
            }
        }
        
        $klant->delete();

        return redirect()->route('kassatickets.index')->with('success', 'Klant met de naam ' . $klant->voornaam . ' ' . $klant->achternaam . ' is succesvol verwijderd!');
    }
}
