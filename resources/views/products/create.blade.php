@extends('layout.app')
@section('content')
<x-navbar/>
<form action='{{route('products.store')}}' class='flex items-center justify-center' method='POST'>
    @csrf
    <div class="container mx-auto w-1/3 shadow-2xl mt-20 px-4 py-8">
        <h1 class="text-3xl font-bold text-blue-300 mb-6">Add New Product</h1>
        <div class="mb-4">
            <label for="product_name" class="block text-gray-700 text-sm font-bold mb-2">Product Name</label>
            <input type="text" name="product_name" id="product_name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500">
            @error('product_name')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="product_Code" class="block text-gray-700 text-sm font-bold mb-2">Product Code</label>
            <input type="text" name="product_Code" id="product_Code" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500">
            @error('product_Code')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="unit_price" class="block text-gray-700 text-sm font-bold mb-2">Unit Price</label>
            <input type="number" name="unit_price" id="unit_price" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500">
            @error('price')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Product</button>
        </div>
    </div>
</form>
@endsection