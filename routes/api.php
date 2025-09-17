<?php

use App\Http\Controllers\BrokerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/brokers', [BrokerController::class, 'create']);
