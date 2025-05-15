<?php

namespace App\Http\Controllers;

use App\Models\Stockin;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StockinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stockins = Stockin::with('product')->get();
        return view('stockins.index', compact('stockins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('user_id', Auth::id())->get();
        return view('stockins.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'quantity' => 'required|numeric|min:0',
            'product_id' => 'required|exists:products,product_id',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $user_id = Auth::id(); // Get the ID of the logged-in user

        $existingProduct = Product::where('product_id', $data['product_id'])->first();
        if ($existingProduct) {
            $existingProduct->quantity += $data['quantity'];
            $existingProduct->unit_price = $data['unit_price'];
            $existingProduct->user_id = $user_id; 
            $existingProduct->save();

            // Create stockin record even when updating product
            $stockIn = new Stockin($data);
            $stockIn->user_id = $user_id;
            $stockIn->save();

            return redirect()->route('stockins.index')->with('success', 'Stockin updated successfully.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Stockin $stockin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stockin $stockin)
    {
        return view('stockins.edit', compact('stockin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stockin $stockin)
    {
        $data = $request->validate([
            'quantity' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $stockin->update($data);
        return redirect()->route('stockins.index')->with('success', 'Stockin updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stockin $stockin)
    {
        $stockin->delete();
        return redirect()->route('stockins.index')->with('success', 'Stockin deleted successfully.');
    }
}
