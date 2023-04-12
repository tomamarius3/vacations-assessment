<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetVacationsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'start' => 'array',
            'start.eq' => 'date|date_format:Y-m-dTH:i:s',
            'start.lte' => 'date|date_format:Y-m-dTH:i:s',
            'start.gte' => 'date|date_format:Y-m-dTH:i:s',
            'end' => 'array',
            'end.eq' => 'date|date_format:Y-m-dTH:i:s',
            'end.lte' => 'date|date_format:Y-m-dTH:i:s',
            'end.gte' => 'date|date_format:Y-m-dTH:i:s',
            'price' => 'array',
            'price.eq' => 'numeric',
            'price.lte' => 'numeric',
            'price.gte' => 'numeric',
        ];
    }

    public function getFilters(): array
    {
        return array_filter([
            'start' => $this->get('start'),
            'end' => $this->get('end'),
            'price' => $this->get('price')
        ], function($item) {
            return !is_null($item);
        });
    }

}
