<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTingkatKesulitanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_tingkat' => ['required', 'string', 'max:50', 'unique:tingkat_kesulitan,nama_tingkat'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_tingkat' => 'Nama Tingkat Kesulitan',
        ];
    }
}
