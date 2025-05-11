<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AddressController extends Controller
{
    public function index()
    {
        return response()->json(Address::with('user')->get());
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'nama_penerima' => 'required|string|max:255',
                'nomor_hp' => 'required|string|max:20',
                'alamat_lengkap' => 'required|string',
                'kota' => 'required|string|max:100',
                'kode_pos' => 'required|string|max:10',
            ]);

            $address = Address::create($validated);
            return response()->json($address, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function show($id)
    {
        try {
            $address = Address::with('user')->findOrFail($id);
            return response()->json($address);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Address not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $address = Address::findOrFail($id);

            $validated = $request->validate([
                'user_id' => 'sometimes|exists:users,id',
                'nama_penerima' => 'sometimes|string|max:255',
                'nomor_hp' => 'sometimes|string|max:20',
                'alamat_lengkap' => 'sometimes|string',
                'kota' => 'sometimes|string|max:100',
                'kode_pos' => 'sometimes|string|max:10',
            ]);

            $address->update($validated);
            return response()->json($address);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Address not found'], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function destroy($id)
    {
        try {
            $address = Address::findOrFail($id);
            $address->delete();
            return response()->json(['message' => 'Address deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Address not found'], 404);
        }
    }
}