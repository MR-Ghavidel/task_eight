<?php

namespace Database\Seeders;

use App\Enums\DBTables;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpParser\JsonDecoder;

class BrokerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @throws \JsonException
     */
    public function run(): void
    {
        $json = '[{
	            "id" : 1,
	            "first_name" : "mohammadreza",
	            "last_name" : "ghavidel",
	            "email" : "ghavidel@gmail.com",
	            "phone" : "09908941770",
	            "password" : "12345678",
	            "created_at" : "2025-10-10",
	            "updated_at" : "2025-10-10"
            },
            {
	            "id" : 2,
	            "first_name" : "ali",
	            "last_name" : "alizadeh",
	            "email" : "alizadeh@gmail.com",
	            "phone" : "09100947732",
	            "password" : "12345678",
	            "created_at" : "2025-10-10",
	            "updated_at" : "2025-10-10"
            }]';
        $brokers = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        DB::table(DBTables::BROKERS->value)->insert($brokers);
    }
}
