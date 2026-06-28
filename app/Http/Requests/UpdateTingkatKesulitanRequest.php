<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTingkatKesulitanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_tingkat' => ['required', 'string', 'max:50', Rule::unique('tingkat_kesulitan', 'nama_tingkat')->ignore($this->route('tingkat_kesulitan'), 'id_tingkat')],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_tingkat' => 'Nama Tingkat Kesulitan',
        ];
    }
}
