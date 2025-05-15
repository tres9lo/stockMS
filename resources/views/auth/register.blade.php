@extends('layout.app')
@section('content')
<form method="POST" action="{{ route('register') }}" class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
    @csrf
    <div>
        <h2 class="text-2xl font-bold text-center mb-6">Register</h2>
        <p class="text-center text-gray-600 mb-4">Please enter your credentials to register.</p>
       </div>
    <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-amber-500">
        @error('name')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
        <input id="password" type="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-amber-500">
        @error('password')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-6">
        <button type="submit" class="w-full bg-amber-500 text-white font-bold py-2 px-4 rounded-md hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-opacity-50">
            Register
        </button>
    </div>

    <div class="text-center">
        <a href="{{ route('login') }}" class="text-amber-500 hover:text-amber-700 text-sm">Already have an account? Login here</a>
    </div>
</form>

@endsection