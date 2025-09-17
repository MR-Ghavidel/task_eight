<?php

use App\Enums\DBTables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(\App\Enums\DBTables::PROPERTIES->value, static function (Blueprint $table) {
            $table->id();
            $table->foreignId('broker_id')->constrained(DBTables::BROKERS->value)->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->unsignedMediumInteger('area'); //16,777,215
            $table->unsignedBigInteger('price');
            $table->enum('sale_type', ['sale', 'mortgage', 'rent'])->default('sale');
            $table->enum('type', ['villa', 'apartment'])->default('apartment');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('city');
            $table->string('street');
            $table->float('latitude');
            $table->float('longitude');
            $table->unsignedSmallInteger('floor')->nullable()->default(null);
            $table->unsignedSmallInteger('total_floors')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(\App\Enums\DBTables::PROPERTIES->value);
    }
};
