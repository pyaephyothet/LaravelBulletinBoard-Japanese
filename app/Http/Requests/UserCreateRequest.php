<?php

namespace App\Http\Requests;

use App\Rules\EmailFormat;
use App\Rules\PasswordFormat;
use App\Rules\UniqueEmail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class UserCreateRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', new EmailFormat(), new UniqueEmail],
            'role' => ['required', 'integer:0,1'],
            'dob' => ['required', 'date', 'before:' . Carbon::now()->subYears(15)->format('Y-m-d')],
            'phone' => ['required', 'regex:/^[0-9-]+$/'],
            'address' => ['required'],
            'profile' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'password' => ['required', 'string', new PasswordFormat],
            'confirmPwd' => 'required|same:password',

        ];
    }

    public function messages()
    {
        return [
            'password.same' => __("message.error01"),
            'password.max' => __("message.error02"),
            'phone.regex' => __("message.error03"),
            'dob.before' => __("message.error04"),
        ];
    }
}
