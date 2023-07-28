<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class TourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'starting_date' => Carbon::parse($this->starting_date)->toISOString(),
            'ending_date' => Carbon::parse($this->ending_date)->toISOString(),
            'price' => number_format($this->price, 2),
        ];
    }
}
