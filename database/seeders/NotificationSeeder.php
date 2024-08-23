<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notifications')->insert([
            'duration_type' => 'monthly',
            'notification_days' => json_encode([7]),
        ]);

        DB::table('notifications')->insert([
            'duration_type' => 'yearly',
            'notification_days' => json_encode([7,30]),
        ]);
    }
}
