<?php

namespace App\Repository\Tenant;

use App\Enums\DBTables;
use App\Repository\Tenant\Interface\BrokerCommentRepositoryInterface;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BrokerCommentRepository extends TenantBaseRepository implements BrokerCommentRepositoryInterface
{
    protected string $suffix = '_' . DBTables::COMMENTS->value;

    public function createSchemaByBrokerId(int $brokerId): void
    {
        $tableName = $this->prefix . $brokerId . $this->suffix;

        Schema::create($tableName, static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('property_id')->index();
            $table->bigInteger('user_id')->index();
            $table->text('text');
            $table->timestamps();
        });
    }
}
