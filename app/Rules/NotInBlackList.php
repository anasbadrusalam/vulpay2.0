<?php

namespace App\Rules;

use App\Models\BlackList;
use Illuminate\Contracts\Validation\Rule;

class NotInBlackList implements Rule
{
    protected $check = false;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($check)
    {
        $this->check = $check;
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
        if ($this->check) {
            return BlackList::whereNumber($value)->get()->isEmpty();
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Nomor masuk dalam daftar BlackList.';
    }
}
