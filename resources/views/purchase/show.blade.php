@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
    body { font-family: 'Poppins', sans-serif; }
</style>

<div class="w-full bg-gray-50 py-10 font-poppins">

    {{-- 🔥 TOMBOL LIHAT DETAIL PESANAN (PAKAI existingOrder, BUKAN SESSION) --}}
    @if($existingOrder)
        <div class="max-w-6xl mx-auto px-6 mb-4">
            <a href="{{ route('purchase.detail', $existingOrder->id) }}"
               class="text-indigo-600 underline font-semibold">
               Lihat Detail Pesanan Anda →
            </a>
        </div>
    @endif

    {{-- STEP INDICATOR --}}
    <div class="max-w-6xl mx-auto px-6 mb-10">
        <div class="flex items-center space-x-3 text-gray-500 text-sm">
            <div class="flex items-center space-x-2 text-indigo-600 font-semibold">
                <div class="w-7 h-7 flex items-center justify-center bg-indigo-100 rounded-full">1</div>
                <span>Pilih Kategori</span>
            </div>
            <span>›</span> <span>2. Detail Pesanan</span>
            <span>›</span> <span>3. Metode Pembayaran</span>
            <span>›</span> <span>4. Pembayaran</span>
        </div>
    </div>

    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-6">

        {{-- LEFT --}}
        <div class="md:col-span-2 space-y-8">

            {{-- BANNER --}}
            <div class="w-full overflow-hidden rounded-2xl shadow-lg">
                <img src="{{ $concert->image_url }}" class="w-full h-[350px] object-cover">
            </div>

            {{-- CARD KATEGORI --}}
            <div class="bg-white shadow-xl border border-gray-200 rounded-3xl p-8">

                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 rounded-xl bg-indigo-100 flex items-center justify-center">
                        <i class="fa-solid fa-ticket text-indigo-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Kategori Tiket</h2>
                </div>

                <div class="space-y-6">
                    @foreach($ticketTypes as $t)
                        @php $soldOut = $t->sold >= $t->quota; @endphp

                        <div class="relative bg-white border border-gray-200 shadow-md rounded-2xl px-6 py-5">

                            {{-- TICKET CUT --}}
                            <div class="absolute -left-3 top-1/2 -translate-y-1/2 w-7 h-7 bg-white rounded-full border border-gray-200"></div>
                            <div class="absolute -right-3 top-1/2 -translate-y-1/2 w-7 h-7 bg-white rounded-full border border-gray-200"></div>

                            <div class="flex items-center justify-between">

                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="text-lg font-semibold text-gray-800">
                                            {{ strtoupper($t->name) }}
                                        </h3>

                                        @if(!$soldOut)
                                            <span class="bg-indigo-100 text-indigo-700 text-xs font-semibold px-2.5 py-1 rounded-full">On Sale</span>
                                        @else
                                            <span class="bg-red-100 text-red-700 text-xs font-semibold px-2.5 py-1 rounded-full">Sold Out</span>
                                        @endif
                                    </div>

                                    <p class="text-gray-700 text-base font-medium">
                                        Rp{{ number_format($t->price) }}
                                    </p>
                                </div>

                                <div>
                                    @if(!$soldOut)
                                        <button
                                            class="select-ticket px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition"
                                            data-id="{{ $t->id }}"
                                            data-price="{{ $t->price }}">
                                            Pilih Tiket
                                        </button>
                                    @else
                                        <button class="px-6 py-2 bg-gray-300 text-gray-600 rounded-lg font-medium cursor-not-allowed">
                                            Sold Out
                                        </button>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- RIGHT: TOTAL --}}
        <div class="bg-white shadow-lg rounded-2xl p-6 h-fit border border-gray-200">

            <div class="flex items-center gap-2 mb-5">
                <div class="w-7 h-7 bg-indigo-100 text-indigo-600 flex items-center justify-center rounded-lg">
                    <i class="fa-solid fa-bag-shopping text-base"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Rincian Pesanan</h3>
            </div>

            <div id="orderDetailContainer" class="hidden">

                <div class="flex justify-between font-medium text-gray-900 mb-1">
                    <span id="ticketName">-</span>
                    <span id="ticketPrice">Rp0</span>
                </div>

                <p class="text-sm text-gray-500 mb-3">x1</p>

                <hr class="my-4">

                <div class="flex justify-between text-gray-600 text-sm mb-2">
                    <span>Subtotal</span>
                    <span id="subtotalValue">Rp0</span>
                </div>

                <div class="flex justify-between font-semibold text-gray-900 text-lg mb-4">
                    <span>Total 1 Tiket</span>
                    <span id="totalValue">Rp0</span>
                </div>

                <hr class="my-4">
            </div>

            <form id="paymentForm" action="{{ route('purchase.store', $concert->id) }}"
                  method="POST" class="hidden">
                @csrf
            </form>

            <button id="bayarBtn"
                class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold disabled:bg-gray-300 disabled:cursor-not-allowed transition"
                disabled>
                Beli Sekarang
            </button>

        </div>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {

        const bayarBtn = document.getElementById("bayarBtn");
        const form = document.getElementById("paymentForm");

        const detailBox = document.getElementById("orderDetailContainer");
        const ticketName = document.getElementById("ticketName");
        const ticketPrice = document.getElementById("ticketPrice");
        const subtotalValue = document.getElementById("subtotalValue");
        const totalValue = document.getElementById("totalValue");

        document.querySelectorAll('.select-ticket').forEach(button => {

            button.addEventListener('click', function() {

                const id = this.dataset.id;
                const price = parseInt(this.dataset.price);
                const name = this.closest('.relative').querySelector('h3').innerText;

                form.innerHTML = `@csrf
                    <input type="hidden" name="ticket_type_id[]" value="${id}">
                    <input type="hidden" name="quantity[]" value="1">`;

                form.classList.remove("hidden");

                detailBox.classList.remove("hidden");
                ticketName.textContent = name;
                ticketPrice.textContent = "Rp" + price.toLocaleString();
                subtotalValue.textContent = "Rp" + price.toLocaleString();
                totalValue.textContent = "Rp" + price.toLocaleString();

                bayarBtn.disabled = false;

                document.querySelectorAll('.select-ticket').forEach(b => {
                    b.innerText = "Pilih Tiket";
                    b.classList.remove("bg-green-600");
                    b.classList.add("bg-indigo-600");
                });

                this.innerText = "Dipilih";
                this.classList.remove("bg-indigo-600");
                this.classList.add("bg-green-600");
            });
        });

        bayarBtn.addEventListener("click", () => form.submit());
    });
</script>

@endsection
