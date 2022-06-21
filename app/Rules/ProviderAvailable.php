<?php

namespace App\Rules;

use App\Models\Provider;
use Illuminate\Contracts\Validation\Rule;

class ProviderAvailable implements Rule
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
        return Provider::whereName($value)->whereActive(true)->get()->isNotEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Provider gangguan atau tidak tersedia.';
    }
}
