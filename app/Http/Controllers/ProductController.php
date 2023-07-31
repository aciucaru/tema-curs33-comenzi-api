<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedProduct = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'price' => ['required', 'numeric', 'min:0'],
                'weight' => ['required', 'numeric', 'min:0'],
                'color' => ['required', 'string',  'max:255']
            ]
        );

        $product = Product::create($validatedProduct);

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if (!$product)
            return response()->json('Not found!', 404);
        else
            return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product)
            return response()->json('Not found!', 404);
        else
        {
            $validatedProduct = $request->validate(
                [
                    'name' => ['required', 'string', 'max:255'],
                    'price' => ['required', 'numeric', 'min:0'],
                    'weight' => ['required', 'numeric', 'min:0'],
                    'color' => ['required', 'string',  'max:255']
                ]
            );

            $product->update($validatedProduct);

            return response()->json($product, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if(!$product)
            return response()->json('Not found!', 404);
        else
        {
            $product->delete();
            return response()->json('', 204);
        }
    }
}