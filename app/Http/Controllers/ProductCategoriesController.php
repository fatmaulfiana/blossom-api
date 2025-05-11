<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product_Categories;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductCategoriesController extends Controller
{
    public function index()
    {
        return response()->json(Product_Categories::all());
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kategori' => 'required|string|max:100',
            ]);

            $category = Product_Categories::create($validated);
            return response()->json($category, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function show($id)
    {
        try {
            $category = Product_Categories::findOrFail($id);
            return response()->json($category);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Product_Categories::findOrFail($id);

            $validated = $request->validate([
                'kategori' => 'sometimes|string|max:100',
            ]);

            $category->update($validated);
            return response()->json($category);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Product_Categories::findOrFail($id);
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }
}
