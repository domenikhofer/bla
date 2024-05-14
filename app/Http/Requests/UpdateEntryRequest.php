<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntryRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'value' => 'string|nullable',
            'url' => 'string|nullable',
            'image' => 'string|nullable',
            'category.id' => 'required|exists:categories,id',
            'done' => 'boolean',
        ];
    }
}
