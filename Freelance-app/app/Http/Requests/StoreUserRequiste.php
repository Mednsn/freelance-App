<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequiste extends FormRequest
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
    public function rules(): array
    {
        return [
            'firstname'   => 'required | string | max:100',
            'lastname'    => 'required | string | max:100',
            'email'       => 'required | email | unique:users,email',
            'password'    => 'required | min:10',
            'role'        => 'required | string | in:client,freelance',



            'tarif'          => 'required_if:role,freelance|float',
            'portfolio'      => 'required_if:role,freelance|string',
            'disponibilite'  => 'required_if:role,freelance|bool',

            'description' => 'required_if:role,client',
            'entreprise'  =>  'required_if:role,client|string',
        ];
    }
}
