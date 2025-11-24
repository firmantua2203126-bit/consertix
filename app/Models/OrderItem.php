<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id','ticket_type_id','quantity','price'];

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

