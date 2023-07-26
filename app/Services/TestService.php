<?php

namespace App\Services;

class TestService
{
    public function __invoke()
    {
        return __METHOD__;
    }
}