<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class PasswordFormat implements Rule
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

    /**
     * Determine if the Length Validation Rule passes.
     *
     * @var boolean
     */
    public $lengthPasses = true;

    /**
     * Determine if the Uppercase Validation Rule passes.
     *
     * @var boolean
     */
    public $uppercasePasses = true;

    /**
     * Determine if the Uppercase Validation Rule passes.
     *
     * @var boolean
     */
    public $lowercasePasses = true;

    /**
     * Determine if the Numeric Validation Rule passes.
     *
     * @var boolean
     */
    public $numericPasses = true;

    /**
     * Determine if the Special Character Validation Rule passes.
     *
     * @var boolean
     */
    public $specialCharacterPasses = true;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->lengthPasses = (Str::length($value) >= 8);
        $this->uppercasePasses = (Str::lower($value) !== $value);
        $this->lowercasePasses = (Str::upper($value) !== $value);
        $this->numericPasses = ((bool) preg_match('/[0-9]/', $value));
        $this->specialCharacterPasses = ((bool) preg_match('/[^A-Za-z0-9]/', $value));
        return ($this->lengthPasses && $this->uppercasePasses && $this->numericPasses && $this->specialCharacterPasses);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        switch (true) {
            case !$this->uppercasePasses
                && !$this->lowercasePasses
                && $this->numericPasses
                && $this->specialCharacterPasses:
                return 'The :attribute must be at least 8 characters and contain at least one uppercase character and one lowercase character.';

            case !$this->numericPasses
                && !$this->lowercasePasses
                && $this->uppercasePasses
                && $this->specialCharacterPasses:
                return 'The :attribute must be at least 8 characters and contain at least one number and one lowercase character.';

            case !$this->specialCharacterPasses
                && !$this->uppercasePasses
                && $this->numericPasses
                && $this->lowercasePasses:
                return 'The :attribute must be at least 8 characters and contain at least one uppercase character and one special character.';

            case !$this->specialCharacterPasses
                && !$this->lowercasePasses
                && $this->numericPasses
                && $this->uppercasePasses:
                return 'The :attribute must be at least 8 characters and contain at least one lowercase character and one special character.';

            case !$this->specialCharacterPasses
                && $this->lowercasePasses
                && $this->numericPasses
                && $this->uppercasePasses:
                return 'The :attribute must be at least one special character.';

            case !$this->uppercasePasses
                && !$this->numericPasses
                && $this->lowercasePasses
                && $this->specialCharacterPasses:
                return 'The :attribute must be at least 8 characters and contain at least one uppercase character and one number.';

            case !$this->uppercasePasses
                && !$this->specialCharacterPasses
                && !$this->lowercasePasses
                && $this->numericPasses:
                return 'The :attribute must be at least 8 characters and contain at least one uppercase character,one lowercase character and one special character.';

            case !$this->uppercasePasses
                && !$this->numericPasses
                && !$this->specialCharacterPasses
                && $this->lowercasePasses:
                return 'The :attribute must be at least 8 characters and contain at least one uppercase character, one number, and one special character.';

            case !$this->lowercasePasses
                && !$this->numericPasses
                && !$this->specialCharacterPasses
                && $this->uppercasePasses:
                return 'The :attribute must be at least 8 characters and contain at least one lowercase character, one number, and one special character.';

            default:
                return 'The :attribute must be at least 8 characters.';
        }
    }
}
