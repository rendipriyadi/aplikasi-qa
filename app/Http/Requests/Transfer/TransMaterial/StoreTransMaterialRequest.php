<?php

namespace App\Http\Requests\Transfer\TransMaterial;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransMaterialRequest extends FormRequest
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
            'check_material_id' => [
                'required',
            ],
            'jumlah' => [
                'required'
            ],
            'satuan_id' => [
                'required'
            ],
        ];
    }
}
