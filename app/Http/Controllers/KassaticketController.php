<?php

namespace App\Http\Controllers;

use App\Http\Requests\KassaticketRequest;
use App\Models\Kassaticket;
use App\Models\Klant;
use Illuminate\Http\Request;

class KassaticketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $kassaticketPath = $validated['kassaticket']->store('resources/kassatickets');
        
        $klant = Klant::firstOrCreate(
            ['email' => $validated['email']],
            ['voornaam' => $validated['voornaam'],
            'achternaam' => $validated['achternaam'],]
        );

        $kassaticket = Kassaticket::create([
            'klant_id' => $klant->id,
            'bestaand' => $kassaticketPath,
        ]);

        return redirect()->route('kassatickets.create')->with('success', 'Super! We hebben uw kassaticket ontvangen!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
