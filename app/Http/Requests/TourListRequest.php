<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sortBy' => 'in:price',
            'sortOrder' => 'in:asc,desc',
            'dateFrom' => 'date',
            'dateTo' => 'date',
            'priceFrom' => 'numeric',
            'priceTo' => 'numeric',
        ];
    }
}
