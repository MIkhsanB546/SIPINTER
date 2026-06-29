<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AIProcessRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
            'materi_id' => ['nullable', 'exists:materi,id_materi'],
            'user_prompt' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.mimes' => 'Hanya file PDF yang diizinkan.',
            'file.max' => 'Ukuran file PDF maksimal 20 MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'file' => 'File PDF',
            'materi_id' => 'Materi',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->hasFile('file') && !$this->filled('materi_id')) {
                $validator->errors()->add('file', 'Silakan upload file PDF atau tentukan materi.');
            }
        });
    }
}
