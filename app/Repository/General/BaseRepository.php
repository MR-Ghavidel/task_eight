<?php

namespace App\Repository\General;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class BaseRepository
{
    protected string $table;
    protected string $connectionType;

    public function __construct()
    {
        $this->connectionType = DB::connection()->getConfig()['driver'];
    }

    public function query(): Builder
    {
        return DB::connection($this->connectionType)->table($this->table);
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
