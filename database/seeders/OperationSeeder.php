<?php

namespace Database\Seeders;

use App\Models\Operation;
use Illuminate\Database\Seeder;

class OperationSeeder extends Seeder
{
    public function run(): void
    {
        Operation::create([
            'capacity' => 250,
            'start' => now()->setTime(8, 0), // 8 AM 
            'end' => now()->setTime(20, 0), // 8 PM 
        ]);

        Operation::create([
            'capacity' => 250,
            'start' => now()->addDay()->setTime(8, 0),
            'end' => now()->addDay()->setTime(22, 0),
        ]);
    }
}