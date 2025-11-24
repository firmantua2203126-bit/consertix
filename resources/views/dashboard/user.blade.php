<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Dashboard User</h1>
                <p>Selamat datang, {{ Auth::user()->name }}! Kamu login sebagai <strong>User</strong>.</p>
            </div>
        </div>
    </div>
</x-app-layout>
