<?php

namespace App\Http\Requests;

use Carbon\Carbon;
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

    public function wantsJson(): bool
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
            'start.eq' => 'date',
            'start.lte' => 'date',
            'start.gte' => 'date',
            'end' => 'array',
            'end.eq' => 'date',
            'end.lte' => 'date',
            'end.gte' => 'date',
            'price' => 'array',
            'price.eq' => 'numeric',
            'price.lte' => 'numeric',
            'price.gte' => 'numeric',
        ];
    }

    public function getFilters(): array
    {
        return array_filter([
            'start' => $this->extractDateFromFilter('start'),
            'end' => $this->extractDateFromFilter('end'),
            'price' => $this->get('price')
        ], function($item) {
            return !is_null($item);
        });
    }

    private function extractDateFromFilter(string $filterName): ?array
    {
        $start = $this->get($filterName);
        if (!is_null($start)) {
            $key = array_key_first($start);
            return [$key => new Carbon($start[$key])];
        }
        return null;
    }

}
