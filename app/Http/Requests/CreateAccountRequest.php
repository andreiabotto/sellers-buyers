<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cpf' => 'required|unique:App\Models\Account,cpf',
            'email' => 'required|unique:App\Models\Account,email',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'balance' => 'min:0|required'
        ];
    }
}
