<?php

namespace App\Repository\Tenant;

use App\Enums\DBTables;
use App\Repository\Tenant\Interface\BrokerPropertyRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerReactionRepositoryInterface;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BrokerReactionRepository extends TenantBaseRepository implements BrokerReactionRepositoryInterface
{
    protected string $suffix = '_' . DBTables::REACTIONS->value;

    public function createSchemaByBrokerId(int $brokerId): void
    {
        $tableName = $this->prefix . $brokerId . $this->suffix;

        Schema::create($tableName, static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('property_id')->index();
            $table->bigInteger('user_id')->index();
            $table->boolean('is_liked');
            $table->timestamps();
        });
    }
}
