<?php

namespace Database\Seeders;

use App\Enums\DBTables;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpParser\JsonDecoder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @throws \JsonException
     */
    public function run(): void
    {
        $json = '[{
	            "id" : 1,
	            "first_name" : "zahra",
	            "last_name" : "zahraie",
	            "email" : "zahraie@gmail.com",
	            "password" : "12345678",
	            "created_at" : "2025-10-10",
	            "updated_at" : "2025-10-10"
            },
            {
	            "id" : 2,
	            "first_name" : "reza",
	            "last_name" : "rezaie",
	            "email" : "rezaie@gmail.com",
	            "password" : "12345678",
	            "created_at" : "2025-10-10",
	            "updated_at" : "2025-10-10"
            }]';
        $users = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        DB::table(DBTables::USERS->value)->insert($users);
    }
}
