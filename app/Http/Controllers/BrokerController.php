<?php

namespace App\Http\Controllers;

use App\Services\CreateBrokerService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class BrokerController extends Controller
{
    public function __construct(
        private readonly CreateBrokerService $createBrokerService,
    )
    {
    }

    public function create(Request $request)
    {
        $validated = $request->all();

        return $this->createBrokerService->createBrokerWithTables($validated);
    }
}
