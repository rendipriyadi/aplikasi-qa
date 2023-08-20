<?php

namespace App\Http\Requests\CheckMaterial;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCheckMaterialRequest extends FormRequest
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
            'jenis' => [
                'required',
            ],
            'sumber' => [
                'required',
            ],
            'jumlah' => [
                'required',
            ],
            'satuan_id' => [
                'required',
            ],
            'hasil' => [
                'required',
            ],
        ];
    }
}
