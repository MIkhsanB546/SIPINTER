<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSoalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pertanyaan' => ['required', 'string'],
            'pilihan_jawaban' => ['required', 'array', 'min:4'],
            'pilihan_jawaban.*.jawaban' => ['required', 'string'],
            'pilihan_jawaban.*.is_correct' => ['required', 'boolean'],
            'jawaban_benar' => ['required', 'integer', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'pertanyaan' => 'Pertanyaan',
            'pilihan_jawaban' => 'Pilihan Jawaban',
            'pilihan_jawaban.*.jawaban' => 'Jawaban',
            'pilihan_jawaban.*.is_correct' => 'Kunci Jawaban',
            'jawaban_benar' => 'Jawaban Benar',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $jawabanBenar = $this->input('jawaban_benar');
            $pilihan = $this->input('pilihan_jawaban', []);

            if (!isset($pilihan[$jawabanBenar])) {
                $validator->errors()->add('jawaban_benar', 'Indeks jawaban benar tidak valid.');
            }
        });
    }
}
