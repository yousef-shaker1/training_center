<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class save_course extends FormRequest
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
            'name' => 'required|min:3',
            'img' => 'required|image',
            'section_id' => 'required',
            'description' => 'required|min:6',
            'price' => 'required|numeric',
            'Numberofhours' => 'required|numeric',
            'Quantity' => 'required|numeric',
            'type' => 'required',
            'start_data' => 'required|date',
            'end_data' => 'required|date',
        ];
    }
}
