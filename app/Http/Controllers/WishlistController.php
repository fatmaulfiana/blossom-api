<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WishlistController extends Controller
{
    public function index()
    {
        return response()->json(Wishlist::with(['user', 'product'])->get());
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'product_id' => 'required|exists:products,id',
            ]);

            $wishlist = Wishlist::create($validated);
            return response()->json($wishlist, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function show($id)
    {
        try {
            $wishlist = Wishlist::with(['user', 'product'])->findOrFail($id);
            return response()->json($wishlist);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Wishlist item not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $wishlist = Wishlist::findOrFail($id);
            $validated = $request->validate([
                'user_id' => 'sometimes|required|exists:users,id',
                'product_id' => 'sometimes|required|exists:products,id',
            ]);

            $wishlist->update($validated);
            return response()->json($wishlist);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Wishlist item not found'], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function destroy($id)
    {
        try {
            $wishlist = Wishlist::findOrFail($id);
            $wishlist->delete();
            return response()->json(['message' => 'Wishlist item deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Wishlist item not found'], 404);
        }
    }
}