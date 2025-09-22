<?php

namespace App;

use App\Enums\DBTables;
use App\Enums\PropertyStatus;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TenantTablesGenerator
{
    protected string $prefix = 'broker' . '_';

    public function createCommandTableByBrokerId(int $brokerId): void
    {
        $tableName = $this->prefix . $brokerId . '_' . DBTables::COMMENTS->value;

        Schema::create($tableName, static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('property_id')->index();
            $table->bigInteger('user_id')->index();
            $table->text('text');
            $table->timestamps();
        });
    }

    public function createPropertyTableByBrokerId(int $brokerId): void
    {
        $tableName = $this->prefix . $brokerId . '_' . DBTables::PROPERTIES->value;

        Schema::create($tableName, static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('property_id')->index()->unique();
            $table->string('property_title');
            $table->text('property_description');
            $table->enum('status', PropertyStatus::cases());
            $table->timestamps();
        });
    }

    public function createPropertyViewTableByBrokerId(int $brokerId): void
    {
        $tableName = $this->prefix . $brokerId . '_' . DBTables::PROPERTY_VIEWS->value;

        Schema::create($tableName, static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('property_id')->index();
            $table->bigInteger('user_id')->index();
            $table->string('ip');
            $table->string('device')->nullable();
            $table->string('os')->nullable();
            $table->timestamp('viewed_at');
            $table->timestamps();
        });
    }

    public function createReactionTableByBrokerId(int $brokerId): void
    {
        $tableName = $this->prefix . $brokerId . '_' . DBTables::REACTIONS->value;

        Schema::create($tableName, static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('property_id')->index();
            $table->bigInteger('user_id')->index();
            $table->boolean('is_liked')->nullable()->default(null);
            $table->timestamps();
        });
    }

}
