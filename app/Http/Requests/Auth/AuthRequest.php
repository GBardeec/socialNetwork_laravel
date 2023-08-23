<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => ['string', 'required','max:255','min:3'],
            'password' => ['string', 'required'],
        ];
    }
}
