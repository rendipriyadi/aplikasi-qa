<?php

namespace App\Http\Requests\MaterialSubmission;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialSubmissionRequest extends FormRequest
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
            'no_pp' => [
                'required', 'string', 'max:255',
            ],
            'no_permohonan' => [
                'required', 'string', 'max:255',
            ],
            'no_kontrak' => [
                'required', 'string', 'max:255',
            ],
            'divisi_id' => [
                'required', 'integer',
            ],
            'vendor_id' => [
                'required', 'integer',
            ],
            'tgl_permohonan' => [
                'required', 'string', 'max:255',
            ],
            'jenis_pemeriksaan' => [
                'required', 'max:255',
            ],
            'jenis_pekerjaan' => [
                'required', 'string', 'max:255',
            ],
            'kak' => [
                'nullable',
            ],
            'pcm' => [
                'nullable',
            ],
            'brosur' => [
                'nullable',
            ],
            'file_lain' => [
                'nullable',
            ],
        ];
    }
}
