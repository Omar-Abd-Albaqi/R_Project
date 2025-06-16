<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {

        $products = Product::all();

        return response()->json( $products);
    }

     public function getProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

   
    public function create(Request $request)
    {
       
        $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric',
            'description' => 'required|string|max:200',
        ]);

        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

   
    public function update(Request $request, $id)
    {
        $product = Product::find(id: $id);

          
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:50',
            'price' => 'sometimes|required|numeric',
            'description' => 'sometimes|required|string|max:200',
           
        ]);

        
        $product->update($request->all());

        return response()->json($product);
    }

 
    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
