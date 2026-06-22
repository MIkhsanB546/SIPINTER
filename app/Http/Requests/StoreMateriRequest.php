<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMateriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_jenjang' => ['required', 'exists:jenjang,id_jenjang'],
            'id_kategori_materi' => ['required', 'exists:kategori_materi,id_kategori_materi'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'file_materi' => ['nullable', 'file', 'mimes:pdf,docx,pptx', 'max:20480'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id_jenjang' => 'Jenjang',
            'id_kategori_materi' => 'Kategori',
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
            'file_materi' => 'File Materi',
            'thumbnail' => 'Thumbnail',
            'is_published' => 'Status Publikasi',
        ];
    }
}
