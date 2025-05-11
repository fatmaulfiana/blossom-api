<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartsController extends Controller
{
    public function index()
    {
        return response()->json(Carts::with(['user', 'product'])->get());
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1'
            ]);

            $cart = Carts::create($validated);
            return response()->json($cart, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function show($id)
    {
        try {
            $cart = Carts::with(['user', 'product'])->findOrFail($id);
            return response()->json($cart);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $cart = Carts::findOrFail($id);
            $validated = $request->validate([
                'user_id' => 'sometimes|exists:users,id',
                'product_id' => 'sometimes|exists:products,id',
                'quantity' => 'sometimes|integer|min:1'
            ]);

            $cart->update($validated);
            return response()->json($cart);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cart item not found'], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function destroy($id)
    {
        try {
            $cart = Carts::findOrFail($id);
            $cart->delete();
            return response()->json(['message' => 'Cart item deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }
    }
}
