@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <h1 class="text-2xl font-semibold mb-4">Riwayat Pesanan</h1>
        <p class="text-sm text-gray-600 mb-6">Halaman ini menampilkan riwayat tiket yang pernah Anda pesan. Jika belum ada pesanan, Anda akan melihat pesan bahwa riwayat masih kosong.</p>

        {{-- Placeholder: jika nanti ada model Order, tampilkan list di sini --}}
        <div class="text-center text-gray-500 py-12">
            <p>Belum ada riwayat pesanan.</p>
            <p class="mt-2 text-xs">(Ini hanya tampilan awal. Saya bisa hubungkan ke model/pesanan Anda jika Anda mau.)</p>
        </div>
    </div>
</div>
@endsection
