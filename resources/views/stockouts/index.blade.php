@extends('layout.app')
@section('content')
<x-navbar/>
<div class="container mx-auto mt-10 px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Manage StockOut</h1>
    <div class="mb-6">
        <a href="{{ route('stockouts.create') }}" class="bg-amber-500 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded transition duration-300">Add New Stockout</a>
    </div>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($stockouts as $stockout)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $stockout->product->product_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $stockout->quantity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${{ number_format($stockout->unit_price, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex space-x-3">
                                <a href="{{ route('stockins.edit', $stockout->stockout_id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                <form action="{{ route('stockins.destroy', $stockout->stockout_id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection