<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Concert;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TicketType;

class PurchaseController extends Controller
{
    public function show(Concert $concert)
    {
      // Ambil order sebelumnya (kalau ada)
    $existingOrder = Order::where('user_id', Auth::id())
        ->where('concert_id', $concert->id)
        ->first();

    return view('purchase.show', [
        'concert'       => $concert,
        'ticketTypes'   => $concert->ticketTypes,
        'user'          => Auth::user(),
        'existingOrder' => $existingOrder
    ]);
    }

    public function store(Request $request, Concert $concert)
    {
        $existingOrder = Order::where('user_id', Auth::id())
            ->where('concert_id', $concert->id)
            ->first();

        if ($existingOrder) {
            return back()->with('error', 'Anda sudah membeli tiket untuk konser ini.');
        }

        // 2. Hitung jumlah tiket yg dibeli
        $totalQty = array_sum($request->quantity);

        if ($totalQty > 1) {
            return back()->with('error', 'Anda hanya boleh membeli 1 tiket.');
        }


        $total = 0;
        $items = [];

        foreach ($request->ticket_type_id as $i => $typeId) {

            $qty = (int)$request->quantity[$i];

            if ($qty <= 0) continue;

            $type = TicketType::find($typeId);

            $total += $type->price * $qty;

            $items[] = [
                'ticket_type_id' => $type->id,
                'quantity'       => $qty,
                'price'          => $type->price,
            ];
        }

        $order = Order::create([
            'user_id'      => auth()->id(),
            'concert_id'   => $concert->id,   // ← WAJIB ADA
            'buyer_name'   => auth()->user()->name,
            'buyer_email'  => auth()->user()->email,
            'total_amount' => $total,
            'status'       => 'pending',
        ]);

        session(['last_order_id' => $order->id]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id'       => $order->id,
                'ticket_type_id' => $item['ticket_type_id'],
                'quantity'       => $item['quantity'],
                'price'          => $item['price'],
            ]);

            TicketType::where('id', $item['ticket_type_id'])
                ->increment('sold', $item['quantity']);
        }


return redirect()->route('purchase.detail', $order->id);


    }
    public function detail(Order $order)
    {
        return view('purchase.detail', [
            'order' => $order,
            'concert' => $order->concert,
            'ticket' => $order->items->first()->ticketType
        ]);
    }

    public function processDetail(Request $request, Order $order)
    {
        $order->update([
            'buyer_name' => $request->name,
            'buyer_email' => $request->email,
            'buyer_phone' => $request->phone,
        ]);

        return redirect()->route('purchase.payment', $order->id);
    }
}
