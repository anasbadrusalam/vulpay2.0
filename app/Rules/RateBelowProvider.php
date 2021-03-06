<?php

namespace App\Rules;

use App\Models\Provider;
use Illuminate\Contracts\Validation\Rule;

class RateBelowProvider implements Rule
{
    protected $provider;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($provider)
    {
        $this->provider = $provider;
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
        $this->provider = Provider::whereName($this->provider)->first();

        if ($this->provider) {
            return $value <= $this->provider->rate;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->provider ? 'Rate tidak boleh lebih tinggi dari ' . $this->provider->rate : 'Provder gangguan atau tidak tersedia.';
    }
}
