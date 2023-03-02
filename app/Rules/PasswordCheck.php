<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class PasswordCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        //$user = Hash::check($value, 'password');
        //$user = Auth::attempt(['password' => $value]);
        //dd($user);
        $user = User::where('password', $value)->first();
        return $user ? true : false;
    }

    public function message()
    {
        return 'Your password is incorrect.';
    }
}