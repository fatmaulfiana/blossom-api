<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductsController extends Controller
{
    public function index()
    {
        return response()->json(Products::with('category')->get());
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'description' => 'nullable|string',
                'harga' => 'required|numeric|min:0',
                'stok' => 'required|integer|min:0',
                'kategori' => 'required|string|max:255',
                'gambar' => 'nullable|string'
            ]);

            $product = Products::create($validated);
            return response()->json($product, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function show($id)
    {
        try {
            $product = Products::with('category')->findOrFail($id);
            return response()->json($product);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Products::find($id);

            if (!$product) {
                return response()->json([
                    'error' => 'Product not found'
                ], 404);
            }

            $validated = $request->validate([
                'nama' => 'sometimes|required|string|max:255',
                'deskripsi' => 'nullable|string',
                'harga' => 'sometimes|required|numeric',
                'stok' => 'sometimes|required|integer',
                'kategori' => 'sometimes|required|string',
            ]);

            $product->update($validated);

            return response()->json([
                'message' => 'Product updated successfully',
                'data' => $product
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Products::findOrFail($id);
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
}
