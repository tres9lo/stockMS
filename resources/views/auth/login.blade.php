@extends('layout.app')
@section('content')
<form method="POST" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md mt-10" action="{{ route('login') }}">
    @csrf
    
    @session('success')
        <div class="mb-4 p-4 rounded-md bg-green-100 text-green-700">{{ session('success') }}</div>
    @endsession
   <div>
    <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
    <p class="text-center text-gray-600 mb-4">Please enter your credentials to login.</p>
   </div>

    <div class="mb-6">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
        <input id="name" 
               type="text" 
               name="name" 
               value="{{ old('name') }}" 
               required 
               autofocus
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500">
        @error('name')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-6">
        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
        <input id="password" 
               type="password" 
               name="password" 
               required
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500">
        @error('password')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-6">
        <button type="submit" 
                class="w-full bg-amber-500 text-white py-2 px-4 rounded-md hover:bg-amber-600 transition duration-300">
            Login
        </button>
    </div>

    <div class="text-center">
        <a href="{{ route('register') }}" class="text-amber-500 hover:text-amber-600 text-sm">
            New Here? Register here
        </a>
    </div>
</form>
@endsection