<?php

namespace App\Repository\Tenant;

use App\Enums\DBTables;
use App\Repository\Tenant\Interface\BrokerPropertyRepositoryInterface;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BrokerPropertyRepository extends TenantBaseRepository implements BrokerPropertyRepositoryInterface
{
    protected string $suffix = '_' . DBTables::PROPERTIES->value;

    public function createSchemaByBrokerId(int $brokerId): void
    {
        $tableName = $this->prefix . $brokerId . $this->suffix;

        Schema::create($tableName, static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('property_id')->index();
            $table->string('property_title');
            $table->text('property_description');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }
}
