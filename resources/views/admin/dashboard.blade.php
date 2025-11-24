@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold text-indigo-700">🛡️ Admin Dashboard</h1>
                <p class="mt-2">Selamat datang, Admin! Kelola event, EO, dan pengguna di sini.</p>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-50 p-4 rounded">
                        <h3 class="font-semibold">Event</h3>
                        <p>12 event aktif</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded">
                        <h3 class="font-semibold">EO</h3>
                        <p>5 EO terdaftar</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded">
                        <h3 class="font-semibold">User</h3>
                        <p>89 pengguna</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection