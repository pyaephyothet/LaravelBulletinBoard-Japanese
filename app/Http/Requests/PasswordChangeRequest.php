<?php

namespace App\Http\Requests;

use App\Rules\CurrentPasswordCheck;
use App\Rules\PasswordFormat;
use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'currentPwd' => ['required', 'string', new CurrentPasswordCheck],
            'newPwd' => ['required', 'string', new PasswordFormat],
            'confirmPwd' => ['required', 'same:newPwd', 'string', new PasswordFormat],
        ];

    }

    public function messages()
    {
        return [
            'password.same' => __("message.error01"),
        ];
    }
}
