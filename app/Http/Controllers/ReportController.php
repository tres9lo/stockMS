<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\stockin;
use App\Models\stockout;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $stockins = stockin::all();
        $stockouts = stockout::all();

        return view('reports.index', compact('products', 'stockins', 'stockouts'));
    }

    public function generateReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $stockins = Stockin::whereBetween('created_at', [$startDate, $endDate])->get();
        $stockouts = Stockout::whereBetween('created_at', [$startDate, $endDate])->get();
        $products = Product::whereHas('stockins', function($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        })->orWhereHas('stockouts', function($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        })->get();

        

        return view('reports.index', compact('stockins', 'stockouts', 'startDate', 'endDate'));
    }}
