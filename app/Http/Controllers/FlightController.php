<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;

class FlightController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_name' => 'required|string|max:255',
            'takeoff_location' => 'required|string|max:255',
            'landing_location' => 'required|string|max:255',
            'operating_days' => 'required|array',
        ]);

        $flight = Flight::create([
            'flight_name' => $validated['flight_name'],
            'takeoff_location' => $validated['takeoff_location'],
            'landing_location' => $validated['landing_location'],
            'operating_days' => json_encode($validated['operating_days']),
        ]);

        return response()->json(['message' => 'Flight added successfully!', 'flight' => $flight]);
    }

    // User: Search for flights
    public function search(Request $request)
    {
        $request->validate([
            'boarding_location' => 'required|string|max:255',
            'destination_location' => 'required|string|max:255',
            'date_of_travel' => 'required|date',
        ]);

        $dayOfWeek = date('l', strtotime($request->date_of_travel));

        $flights = Flight::where('takeoff_location', $request->boarding_location)
                         ->where('landing_location', $request->destination_location)
                         ->whereJsonContains('operating_days', $dayOfWeek)
                         ->get();

        return response()->json($flights);
    }
}
