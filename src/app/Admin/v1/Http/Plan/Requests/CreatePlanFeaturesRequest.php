<?php
namespace App\Admin\v1\Http\Plan\Requests;

use Domain\Plan\Enums\DurationTypes;
use Domain\Plan\Enums\PlanTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreatePlanFeaturesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('features', 'name')
            ],
            'key' => [
                'required',
                'string',
                'min:3',
                'max:55',
                Rule::unique('features', 'key')
            ],
            'description' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
        ];
    }
}
