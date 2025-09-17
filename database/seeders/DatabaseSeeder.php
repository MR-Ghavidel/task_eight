<?php

namespace Database\Seeders;

use App\Enums\DBTables;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpParser\JsonDecoder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @throws \JsonException
     */
    public function run(): void
    {
        $this->call([
            BrokerSeeder::class,
            UserSeeder::class,
        ]);
    }
}
