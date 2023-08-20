<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

// this rule only at update request
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
                // Rule unique only works for other record id
            ],
            'username' => [
                'required', 'string', 'max:255', Rule::unique('users')->ignore($this->user),
                // Rule unique only works for other record id
            ],
            // add validation for role this here
        ];
    }
}
