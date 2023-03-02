<?php

namespace App\Http\Requests;

use App\Rules\EmailCheck;
use App\Rules\EmailFormat;
use App\Rules\PasswordFormat;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', new EmailFormat(), new EmailCheck],
            'password' => ['required', 'string', new PasswordFormat],
        ];
    }
}
