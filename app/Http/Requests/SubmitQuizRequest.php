<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitQuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jawaban' => ['required', 'array'],
            'jawaban.*' => ['required', 'exists:pilihan_jawaban,id_pilihan_jawaban'],
        ];
    }

    public function attributes(): array
    {
        return [
            'jawaban' => 'Jawaban',
            'jawaban.*' => 'Setiap jawaban',
        ];
    }
}
