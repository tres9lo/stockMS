@extends('layout.app')
@section('content')
<div class="container mx-auto mt-10 px-4 py-8">
    <x-navbar/>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Products</h1>
            <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Product
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Code</th>
                        <th class="py-3 px-6 text-right">Unit_price</th>
                        <th class="py-3 px-6 text-center">Quantity</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @if($products && count($products) > 0)
                        @foreach($products as $product)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ $product->product_name }}</td>
                                <td class="py-3 px-6 text-left">{{ $product->product_Code }}</td>
                                <td class="py-3 px-6 text-right">${{ number_format($product->unit_price, 2) }}</td>
                                <td class="py-3 px-6 text-center">{{$product->quantity}}</td>
                                <td class="py-3 px-6 text-center">
                                    <a href="{{ route('products.edit', $product->product_id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    <form action="{{ route('products.destroy', $product->product_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 ml-4">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center py-4">No products available.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            @if($products)
                {{ $products->links() }}
            @endif
        </div>
    </div>
@endsection