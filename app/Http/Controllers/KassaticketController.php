<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Requests\KassaticketRequest;
use App\Models\Kassaticket;
use App\Models\Klant;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class KassaticketController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware(['auth', AdminMiddleware::class], only: ['index', 'destroy']),
        ];
    }
    /**
     * Toon de indexpagina voor kassatickets met optionele zoekfunctionaliteit.
     */
    public function index(Request $request)
    {
        $zoekterm = $request->input('query');
        $kassatickets = Kassaticket::when($zoekterm, function ($query, $zoekterm) {
            $query->whereHas('klant', function ($query) use ($zoekterm) {
                $query->where('voornaam', 'like', "%$zoekterm%")
                ->orWhere('achternaam', 'like', "%$zoekterm%")
                ->orWhere('email', 'like', "%$zoekterm%");
            });
        })->get();
        return view('kassatickets', compact('kassatickets'));
    }

    /**
     * Toon het formulier om een nieuwe kassaticket aan te maken.
     */
    public function create()
    {
        return view('kassaticket_form');
    }

    /**
     * Sla de aangemaakte kassaticket met zijn klant gegevens als een aparte model op in de database
     */
    public function store(KassaticketRequest $request)
    {
        $validated = $request->validated();

        $kassaticketPath = $validated['kassaticket']->store('kassatickets', 'public');
        
        $klant = Klant::firstOrCreate(
            ['email' => $validated['email']],
            ['voornaam' => $validated['voornaam'],
            'achternaam' => $validated['achternaam'],]
        );

        Kassaticket::create([
            'klant_id' => $klant->id,
            'bestaand' => $kassaticketPath,
        ]);

        return redirect()->route('kassatickets.create')->with('success', 'Super! We hebben uw kassaticket ontvangen!');
    }

    /**
     * Display the specified resource.
     * Automatisch gegenereerd, maar niet gebruikt voor deze versie van de applicatie.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * Automatisch gegenereerd, maar niet gebruikt voor deze versie van de applicatie.
     * Omdat er geen gegevens zijn die voor dit model aangepaast kunnen worden, heb ik het alleen mogelijk gemaakt om het kassaticket samen met het bestand te verwijderen via de method destroy.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * Automatisch gegenereerd, maar niet gebruikt voor deze versie van de applicatie.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Verwijder het kassaticket met het bestand
     */
    public function destroy($id)
    {
        $kassaticket = Kassaticket::findOrFail($id);
        Storage::disk('public')->delete($kassaticket->bestaand);
        $kassaticket->delete();

        return redirect()->route('kassatickets.index')->with('success', 'Kassaticket succesvol verwijderd!');
    }
}
