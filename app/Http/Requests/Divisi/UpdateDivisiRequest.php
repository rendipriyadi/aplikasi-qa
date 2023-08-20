<?php

namespace App\Http\Requests\Divisi;

use Illuminate\Foundation\Http\FormRequest;

// this rule only at update request
use Illuminate\Validation\Rule;

class UpdateDivisiRequest extends FormRequest
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
                'required', 'string', 'max:255', Rule::unique('divisi')->ignore($this->divisi),
            ],
        ];
    }
}
