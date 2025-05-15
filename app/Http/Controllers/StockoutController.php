<?php

namespace App\Http\Controllers;

use App\Models\Stockout;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StockoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stockouts = Stockout::with('product')->get();
        return view('stockouts.index', compact('stockouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('user_id', Auth::id())->get();
        return view('stockouts.create', compact('products'));
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

        $user_id = Auth::id();

        $product = Product::where('product_id', $data['product_id'])->first();
        
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        if ($product->quantity < $data['quantity']) {
            return redirect()->back()->with('error', 'Insufficient stock quantity.');
        }

        // Create stockout record
        $stockout = new Stockout();
        $stockout->quantity = $data['quantity'];
        $stockout->product_id = $data['product_id'];
        $stockout->unit_price = $data['unit_price'];
        $stockout->user_id = $user_id;
        $stockout->save();

        // Update product quantity
        $product->quantity -= $data['quantity'];
        $product->save();

        return redirect()->route('stockouts.index')->with('success', 'Stockout created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stockout $stockout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stockout $stockout)
    {
        return view('stockouts.edit', compact('stockout'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stockout $stockout)
    {
        $data = $request->validate([
            'quantity' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $stockout->update($data);
        return redirect()->route('stockouts.index')->with('success', 'Stockout updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stockout $stockout)
    {
        $stockout->delete();
        return redirect()->route('stockouts.index')->with('success', 'Stockout deleted successfully.');
    }
}
