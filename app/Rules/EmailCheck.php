<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class EmailCheck implements Rule
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
        $user = User::where('email', $value)->first();
        return $user ? true : false;
    }

    public function message()
    {
        return 'Your email is incorrect.';
    }
}
