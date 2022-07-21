<?php

namespace App\Rules;

use App\Models\Provider;
use App\Notifications\TelegramNotification;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Notification;

class ReceiverAvailable implements Rule
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
        $provider = Provider::whereName($value)->first();

        if ($provider) {
            if ($provider->getReceiver()) {
                return true;
            }
            $provider->update(['active' => false]);
            
            $content = "Provider ".$provider->name. " Gangguan";
            Notification::route('telegram', config('services.telegram-bot-api.chat-id'))
                ->notify(new TelegramNotification($content));
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
        return 'Provider gangguan atau tidak tersedia.';
    }
}
