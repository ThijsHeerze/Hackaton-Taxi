<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReisController extends Controller
{
    public function index()
    {
        return view('reis.form');
    }

    public function bereken(Request $request)
    {
        $request->validate([
            'bestemming' => 'required|string',
        ]);

        $bestemming = $request->input('bestemming');
        $startLocatie = 'Amsterdam';

        $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
            'origins' => $startLocatie,
            'destinations' => $bestemming,
            'key' => env('AIzaSyDBEULKyndBUuSl3TX4tuwiTgZTCHn0JVU'),

            
        ]);

        // dd($response->json());
        $data = $response->json();

        if (isset($data['rows'][0]['elements'][0]['duration'])) {
            $reistijd = $data['rows'][0]['elements'][0]['duration']['text'];
            $afstand = $data['rows'][0]['elements'][0]['distance']['value'] / 1000; // Afstand in km

            // Eenvoudige kostenberekening, bijvoorbeeld €1 per kilometer
            $kosten = $afstand * 1;

            return view('reis.resultaat', compact('reistijd', 'afstand', 'kosten'));
        } else {
            return back()->withErrors(['message' => 'Kan de reistijd niet berekenen, controleer de bestemming']);
        }
    }
}