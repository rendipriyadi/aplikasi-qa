<?php

namespace App\Http\Requests\Transfer\TransferMaterial;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransferMaterialRequest extends FormRequest
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
            'tgl_penyerahan' => [
                'required', 'max:255',
            ],
            'lokasi' => [
                'required', 'max:255',
            ],
        ];
    }
}
