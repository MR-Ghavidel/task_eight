<?php

namespace App\Repository\Tenant;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class TenantBaseRepository
{
    protected string $prefix = 'broker' . '_';

    protected string $suffix;

    protected string $connectionType;

    public function __construct()
    {
        $this->connectionType = DB::connection()->getConfig()['driver'];
    }

    public function query(int $brokerId): Builder
    {
        $tableName = $this->prefix . $brokerId . $this->suffix;

        return DB::connection($this->connectionType)->table($tableName);
    }

    public function createdAt(): array
    {
        return [
            'created_at' => date("Y-m-d h:i:s"),
        ];
    }

    public function updatedAt(): array
    {
        return [
            'updated_at' => date("Y-m-d h:i:s")
        ];
    }
}
