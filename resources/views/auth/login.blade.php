@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md">
    <h1 class="text-2xl font-bold mb-4">Login</h1>
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border p-2" required />
        </div>
        <div class="mb-4">
            <label class="block mb-1">Password</label>
            <input type="password" name="password" class="w-full border p-2" required />
        </div>
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="remember" class="mr-2" /> Remember me
            </label>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2">Login</button>
    </form>
    <div class="mt-4">
        <p>Default roles: Admin, Super Admin</p>
    </div>
    </div>
@endsection


