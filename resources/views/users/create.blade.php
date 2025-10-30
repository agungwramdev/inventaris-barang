@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Tambah User</h1>
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="mb-3">
            <label class="block mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border p-2" required>
            @error('name')<div class="text-red-600">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border p-2" required>
            @error('email')<div class="text-red-600">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="block mb-1">Role</label>
            <select name="role" class="w-full border p-2" required>
                <option value="Admin" {{ old('role')==='Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Super Admin" {{ old('role')==='Super Admin' ? 'selected' : '' }}>Super Admin</option>
            </select>
            @error('role')<div class="text-red-600">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="block mb-1">Password</label>
            <input type="password" name="password" class="w-full border p-2" required>
            @error('password')<div class="text-red-600">{{ $message }}</div>@enderror
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2">Simpan</button>
            <a href="{{ route('users.index') }}" class="px-4 py-2 border">Batal</a>
        </div>
    </form>
</div>
@endsection


