<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booked;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookedController extends Controller
{
    public function index()
    {
        return response()->json(Booked::with(['user', 'product'])->get());
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
                'booked_date' => 'required|date',
            ]);

            $booked = Booked::create($validated);
            return response()->json($booked, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function show($id)
    {
        try {
            $booked = Booked::with(['user', 'product'])->findOrFail($id);
            return response()->json($booked);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Booked item not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $booked = Booked::findOrFail($id);

            $validated = $request->validate([
                'user_id' => 'sometimes|exists:users,id',
                'product_id' => 'sometimes|exists:products,id',
                'quantity' => 'sometimes|integer|min:1',
                'booked_date' => 'sometimes|date',
            ]);

            $booked->update($validated);
            return response()->json($booked);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Booked item not found'], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function destroy($id)
    {
        try {
            $booked = Booked::findOrFail($id);
            $booked->delete();
            return response()->json(['message' => 'Booked item deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Booked item not found'], 404);
        }
    }
}