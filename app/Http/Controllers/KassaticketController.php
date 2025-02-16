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
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kassaticket_form');
    }

    /**
     * Store a newly created resource in storage.
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
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kassaticket = Kassaticket::findOrFail($id);
        Storage::disk('public')->delete($kassaticket->bestaand);
        $kassaticket->delete();

        return redirect()->route('kassatickets.index')->with('success', 'Kassaticket succesvol verwijderd!');
    }
}
