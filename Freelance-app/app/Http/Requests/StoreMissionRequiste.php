<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMissionRequiste extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    // public function rules(): array
    // {
    //     return [

    //     ];
    // }
    public function rules()
    {
        return [
            'titre' => 'required|string|max:255',
            'description' => 'required|text',
            'budget' => 'required|numeric|min:0',
            'duree_by_day' => 'required|integer|min:1',
            'type' => 'required',
            'technologies' => 'nullable|array',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
