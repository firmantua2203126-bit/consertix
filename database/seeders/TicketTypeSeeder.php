<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketType;   // <- WAJIB DITAMBAHKAN

class TicketTypeSeeder extends Seeder
{
    public function run(): void
    {
        TicketType::create([
            'concert_id' => 1,
            'name' => 'VIP',
            'price' => 1500000,
            'quota' => 100,
        ]);

        TicketType::create([
            'concert_id' => 1,
            'name' => 'Regular',
            'price' => 750000,
            'quota' => 500,
        ]);
    }
}
