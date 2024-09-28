<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class update_course extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|min:3',
            'img' => 'nullable|image',
            'section_id' => 'nullable',
            'description' => 'nullable|min:6',
            'price' => 'nullable|numeric',
            'Numberofhours' => 'nullable|numeric',
            'Quantity' => 'nullable|numeric',
            'type' => 'nullable',
            'start_data' => 'nullable|date',
            'end_data' => 'nullable|date',
        ];
    }
}
