<?php

namespace App\Rules;

use App\Models\Receiver;
use Illuminate\Contracts\Validation\Rule;

class NotServerNumber implements Rule
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
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Receiver::whereNumber($value)->get()->isEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Nomor pengirim pulsa salah.';
    }
}
