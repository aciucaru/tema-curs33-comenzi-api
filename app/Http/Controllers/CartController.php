<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::all();

        return response()->json($carts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedCart = $request->validate(
            [ 'user_id' => ['required', 'numeric'] ]
        );

        $cart = Cart::create($validatedCart);

        return response()->json($cart, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cart = Cart::find($id);
        $cart->products = $cart->products;

        if(!$cart)
            return response()->json('Not found', 404);
        else
            return response()->json($cart, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cart = Cart::find($id);

        if(!$cart)
            return response()->json('Not found', 404);
        else
        {
            $validatedCart = $request->validate(
                [ 'user_id' => ['required', 'numeric'] ]
            );

            $cart->update($validatedCart);
            return response()->json($cart, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::find($id);

        if(!$cart)
            return response()->json('Not found', 404);
        else
        {
            $cart->delete();
            return response()->json('', 204);
        }
    }

    public function addProduct(Request $request, string $userId)
    {
        $cart = Cart::where('user_id', $userId)->first();

        if(!$cart)
        {
            $cart = new Cart();
            $cart->user_id = $userId;
            $cart->save();

            $validatedRequestData = $request->validate(
                [ 'product_id' => ['required', 'numeric'] ]
            );

            // attach() se foloseste pentru relatii 'many to many', care se obtin cu tabele pivot
            // se adauga un produs la cart-ul curent dar si in tabelul pivot al relatiei 'many to many'
            $cart->products()->attach($validatedRequestData['product_id']);
        }
        else
        {
            $validatedRequestData = $request->validate(
                [ 'product_id' => ['required', 'numeric'] ]
            );

            $cart->products()->attach($validatedRequestData['product_id']);
        }


        return response()->json($cart, 201);
    }

    public function removeProduct(Request $request, string $userId)
    {
        $cart = Cart::where('user_id', $userId)->first();

        if(!$cart)
            return response()->json('Not found', 404);
        else
        {
            $validatedRequestData = $request->validate(
                [ 'product_id' => ['required', 'numeric'] ]
            );

            $cart->products()->detach($validatedRequestData['product_id']);
            return response()->json($cart, 201);
        }
    }
}
