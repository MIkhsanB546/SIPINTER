<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJenjangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_jenjang' => ['required', 'string', 'max:50', Rule::unique('jenjang', 'nama_jenjang')->ignore($this->route('jenjang'), 'id_jenjang')],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_jenjang' => 'Nama Jenjang',
        ];
    }
}
