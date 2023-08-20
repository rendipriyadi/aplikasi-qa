<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => [
                'required', 'string', 'max:255',
            ],
            'jabatan' => [
                'required', 'max:255',
            ],
            'username' => [
                'required', 'string', 'unique:users', 'max:255',
            ],
            'password' => [
                'required', 'string', 'max:255',
            ],
            // add validation for role this here
        ];
    }
}
