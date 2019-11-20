<?php

namespace TobiSchulz\TrashmailChecker\Rules;

use TobiSchulz\TrashmailChecker\Facade\TrashmailChecker;
use Illuminate\Contracts\Validation\Rule;

class NoTrashmail implements Rule
{
    public $trashmailChecker;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return TrashmailChecker::check($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('trashmailchecker::trashmailchecker.messages.validation_error');
    }
}
