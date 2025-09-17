<?php

namespace App\Repository\Tenant;

use App\Enums\DBTables;
use App\Repository\Tenant\Interface\BrokerPropertyRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerPropertyViewRepositoryInterface;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BrokerPropertyViewRepository extends TenantBaseRepository implements BrokerPropertyViewRepositoryInterface
{
    protected string $suffix = '_' . DBTables::PROPERTY_VIEWS->value;

    public function createSchemaByBrokerId(int $brokerId): void
    {
        $tableName = $this->prefix . $brokerId . $this->suffix;

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
}
