<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_materi' => ['required', 'exists:materi,id_materi'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'durasi_menit' => ['nullable', 'integer', 'min:1', 'max:999'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id_materi' => 'Materi',
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
            'durasi_menit' => 'Durasi (menit)',
        ];
    }
}
