<?php

namespace Database\Seeders;

use App\Models\Capsule;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CapsuleSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user pertama
        $user = User::first();

        if (! $user) {
            return;
        }

        $capsules = [
            // LOCKED
            [
                'message' => 'This is a capsule that will open tomorrow.',
                'unlock_date' => Carbon::now()->addDay(),
            ],
            [
                'message' => 'A message for next week.',
                'unlock_date' => Carbon::now()->addWeeks(2),
            ],
            [
                'message' => 'A long-term capsule for next year.',
                'unlock_date' => Carbon::now()->addYear(),
            ],

            // UNLOCKED
            [
                'message' => 'A capsule opened yesterday.',
                'unlock_date' => Carbon::now()->subDay(),
            ],
            [
                'message' => 'A capsule opened two weeks ago.',
                'unlock_date' => Carbon::now()->subWeeks(2),
            ],
            [
                'message' => 'A capsule opened one year ago.',
                'unlock_date' => Carbon::now()->subYear(),
            ],
        ];

        foreach ($capsules as $data) {
            Capsule::create([
                'user_id'     => $user->id,
                'message'     => $data['message'],
                'unlock_date' => $data['unlock_date'],
                // is_unlocked akan otomatis true kalau tanggal <= sekarang
            ]);
        }
    }
}
