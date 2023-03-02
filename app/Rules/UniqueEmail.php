<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UniqueEmail implements Rule
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
        return $user ? false : true;
    }

    public function message()
    {
        return 'The email is already in use.';
    }
}
