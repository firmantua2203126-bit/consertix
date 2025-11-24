<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ConcertSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('concerts')->insert([
            [
                'title' => 'FREEDOM EXODUS',
                'location' => 'Jakarta Timur',
                'date' => '2026-01-24',
                'price' => 58500,
                'image_url' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=900&q=80',
                'status' => 'Tiket Tersedia',
                'organizer' => 'PRADIA FEST',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'WOD Jakarta 2026',
                'location' => 'Jakarta Pusat',
                'date' => '2026-01-31',
                'price' => 200000,
                'image_url' => 'https://images.unsplash.com/photo-1507878866276-a947ef722fee?auto=format&fit=crop&w=900&q=80',
                'status' => 'Tiket Tersedia',
                'organizer' => 'PT Rahayu Indonesia Sentosa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Byon Combat Showbiz Vol.6',
                'location' => 'Jakarta Pusat',
                'date' => '2025-11-22',
                'price' => 150000,
                'image_url' => 'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&w=900&q=80',
                'status' => 'Tiket Tersedia',
                'organizer' => 'PORSENI FKH UNAIR',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'GWK Bali Countdown 2026',
                'location' => 'Bali',
                'date' => '2025-12-31',
                'price' => 175000,
                'image_url' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80',
                'status' => 'Tiket Tersedia',
                'organizer' => 'GWK Organizer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
