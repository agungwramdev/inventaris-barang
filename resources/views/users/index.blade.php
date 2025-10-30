@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Users</h1>
        <a href="{{ route('users.create') }}" class="bg-green-600 text-white px-3 py-2">Tambah User</a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4">{{ session('success') }}</div>
    @endif
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Nama</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Role</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="p-2 border">{{ $user->name }}</td>
                <td class="p-2 border">{{ $user->email }}</td>
                <td class="p-2 border">{{ $user->role }}</td>
                <td class="p-2 border">
                    <a class="text-blue-600 mr-2" href="{{ route('users.edit', $user) }}">Edit</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mt-4">{{ $users->links() }}</div>
</div>
@endsection


