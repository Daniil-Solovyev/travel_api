<?php

namespace App\Http\Controllers;

use App\Services\TestService;

class TestController extends Controller
{
    public function test(TestService $service)
    {
        dd(1);
    }
}
