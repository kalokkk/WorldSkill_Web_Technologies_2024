<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campsite;

class CampsiteController extends Controller
{
    public function list(Request $request) {
        $campsites = Campsite::all()->with('campsiteImages');

        return $campsites;
    }

    public function show(Campsite $campsite, Request $request) {
        return $campsite->load('campsiteImages', 'campsiteSpots');
    }

    public function list_spots(Campsite $campsite, Request $request) {
        $spots = $campsite->campsiteSpots->campsiteDates;

        return $spots;
    }

    public function reserve(Campsite $campsite, Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'remarks' => 'nullable|max:255',
            'campsite_spot' => 'required|exists:App\Models\CampsiteSpot,id'
        ]);

        CampsiteReservation::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'remarks' => $request->input('remarks', ''),
            'campsite_spot_id' => $request->input('campsite_spot'),
            'campsite_id' => $campsite->id,
        ]);

        return response()->json([
            "status"=> "ok",
        ]);
    }
}
