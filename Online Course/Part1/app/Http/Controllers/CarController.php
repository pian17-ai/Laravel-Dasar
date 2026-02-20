<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index() {
        $cars = Car::all();

        return response()->json([
            'messages' => 'success',
            'data' => $cars
        ]);
    }

    public function show($id) {
        $car = Car::find($id);

        if($car == null) {
            return response()->json([
                'messages' => 'Car not found'
            ], 404);
        }

        return response()->json([
            'messages' => 'success',
            'data' => $car
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'type' => 'required',
            'year' => 'integer',
            'price' => 'integer'
        ]);

        $car = Car::create($validated);

        return response()->json([
            'messages' => 'success insert data',
            'data' => $car
        ], 201);
    }

    public function update(Request $request, $id) {
        $car = Car::find($id);

        if($car == null) {
            return response()->json([
                'messages' => 'Car not found'
            ], 404);
        }

        $car->update($request->all());

        return response()->json([
            'messages' => 'success',
            'data' => $car
        ]);
    }

    public function destroy($id) {
        $car = Car::find($id);

        if($car == null) {
            return response()->json([
                'messages' => 'Car not found'
            ], 404);
        }

        $car->delete();

        return response()->json([
            'messages' => 'deleted'
        ]);
    }
}
