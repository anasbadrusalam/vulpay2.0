<?php

namespace App\Rules;

use App\Models\Provider;
use Illuminate\Contracts\Validation\Rule;

class AccordingToProvider implements Rule
{
    protected $message = 'Nominal tidak sesuai ketentuan.';
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
            if ($value >= $this->provider->min && $value <= $this->provider->max) {
                return true;
            }
            $this->message = 'Minimal ' . $this->provider->min . ', Maksimal ' . $this->provider->max;
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
        return $this->message;
    }
}
