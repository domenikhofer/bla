<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntriesRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'entries' => 'required|array',
            'entries.*.value' => 'string|nullable',
            'entries.*.url' => 'string|nullable',
            'entries.*.image' => 'string|nullable',
            'entries.*.category_id' => 'required|exists:categories,id',
        ];
    }
}
