<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaEntryRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'string|nullable',
            'url' => 'required|url',
            'value' => 'required|string|unique:entries,value',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
