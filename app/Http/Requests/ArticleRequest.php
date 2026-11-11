<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'preview_image' => ['required', 'string', 'max:255'],
            'full_image' => ['required', 'string', 'max:255'],
            'short_desc' => ['nullable', 'string', 'max:500'],
            'desc' => ['required', 'string', 'min:10'],
        ];
    }

    public function attributes(): array
    {
        return [
            'date' => 'дата',
            'name' => 'название',
            'preview_image' => 'превью',
            'full_image' => 'полное изображение',
            'short_desc' => 'краткое описание',
            'desc' => 'текст статьи',
        ];
    }
}
