<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * Functia folosita pentru requestul de getAll
     * Aduce din baza de date toate resursele din model
     * In cazul nostru aduce din baza de date toate Orders ( comenzile )
     */
    public function index()
    {
        $orders = Order::all();

        return response()->json($orders, 200);
    }

    /**
     * Store a newly created resource in storage.
     * functia folosita pentru a salva un nou order in baza de date
     * primeste prin request, in cazul nostru BODY din requestul Postman, toate informatiile ce trebuie salvate in baza de date
     */
    public function store(Request $request)
    {
        $validatedOrder = $request->validate(
            [
                'user_id' => ['required', 'numeric'],
                'total_value' => ['required', 'numeric', 'min:0'],
                'total_weight' => ['required', 'numeric', 'min:0'],
                'payment_method' => ['required', 'string', Rule::in(['cash', 'card'])]
            ]
        );

        $order = Order::create($validatedOrder);

        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     * Folosita pentru a trimite ca raspuns json, un singur obiect/resursa/element/rand din tabelul din baza de date
     * Folosim id-ul unic al obiectului/produsului/resursei.. pentru a aduce toate informatiile lui
     */
    public function show(string $id)
    {
        $order = Order::find($id); // find cauta dupa parametrul dat in coloana de ID daca exista o resursa cu acel ID

        if (!$order)
            return response()->json('Not Found', 404);
        else
            return response()->json($order, 200);
    }

    /**
     * Update the specified resource in storage.
     * Este folosita pentru a modificat in baza de date o resursa folsind id-ul pentru a gasi resursa
     * si folosind corpul requestului, reqeust body pentru a prelua valorile
     */
    public function update(Request $request, string $id)
    {
        $order = Order::find($id); // find este folosit pentru a gasit o resursa in baza de date, care are aceeasi valoare la coloana ID
        
        if(!$order)
            return response()->json('Not found', 404);
        else
        {
            $validatedOrder = $request->validate(
                [
                    'user_id' => ['required', 'numeric'],
                    'total_value' => ['required', 'numeric', 'min:0'],
                    'total_weight' => ['required', 'numeric', 'min:0'],
                    'payment_method' => ['required', 'string', Rule::in(['cash', 'card'])]
                ]
            );

            $order->update($validatedOrder);

            return response()->json($order, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     * functia folosita pentru a sterge o resursa din baza de date folosind id-ul primit ca request
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        if (!$order)
            return response()->json('Not found', 404);
        else
        {
            $order->delete();
            return response()->json('', 204);
        }
    }
}