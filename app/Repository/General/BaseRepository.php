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
        $this->connectionType = DB::connection()->getDriverName();
        //dd(DB::connection()->getDriverName());
    }

    public function query(): Builder
    {
        return DB::connection($this->connectionType)->table($this->table);
    }

    public function createdAt(): array
    {
        return [
            'created_at' => now(),
        ];
    }

    public function updatedAt(): array
    {
        return [
            'updated_at' => now(),
        ];
    }
}
