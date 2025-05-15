@extends('layout.app')
@section('content')
<div class ="flex items-center w-full justify-center p-2" >
    <x-navbar/>
    <div class="flex items-center justify-center p-3 shadow-2xl mt-10">
@if ($errors->any())
    @foreach($errors->all() as $error)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ $error }}
        </div>
    @endforeach
@endif

<form action='{{route('stockins.store')}}' method='POST'>
    @csrf
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-amber-700">Add New Stock In</h1>
        <div class="mb-4">
            <label for="product_name" class="block text-amber-700 text-sm font-bold mb-2">Product Name</label>
            <select name="product_id" id="product_id" required class="w-full px-3 py-2 border border-amber-300 rounded-md focus:outline-none focus:ring-amber-500 focus:border-amber-500">
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                @endforeach
            </select>
            @error('product_id')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="quantity" class="block text-amber-700 text-sm font-bold mb-2">Quantity</label>
            <input type="number" name="quantity" id="quantity" required class="w-full px-3 py-2 border border-amber-300 rounded-md focus:outline-none focus:ring-amber-500 focus:border-amber-500">
            @error('quantity')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="unit_price" class="block text-amber-700 text-sm font-bold mb-2">Price</label>
            <input type="number" name="unit_price" id="unit_price" required class="w-full px-3 py-2 border border-amber-300 rounded-md focus:outline-none focus:ring-amber-500 focus:border-amber-500">
            @error('price')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">Add Stock In</button>
        </div>
    </div>
</form>
</div>
</div>
@endsection