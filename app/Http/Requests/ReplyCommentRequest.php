<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyCommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Заполните поле "Заголовок ответа"',
            'content.required' => 'Заполните поле "Текст ответа"',
        ];
    }
}
