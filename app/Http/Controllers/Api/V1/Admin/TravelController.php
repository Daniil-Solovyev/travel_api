<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Travel;
use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequest;
use App\Http\Resources\TravelResource;

class TravelController extends Controller
{
    public function store(TravelRequest $request)
    {
        $travel = Travel::create($request->validated());

        return TravelResource::make($travel);
    }

    public function update(Travel $travel, TravelRequest $request)
    {
        $travel->update($request->validated());

        return TravelResource::make($travel);
    }
}
