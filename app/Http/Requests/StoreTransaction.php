<?php

namespace App\Http\Requests;

use App\Rules\NotServerNumber;
use App\Rules\ProviderAvailable;
use App\Rules\ReceiverAvailable;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransaction extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'provider' => ['bail','required', new ProviderAvailable(), new ReceiverAvailable()],
            'sender' => ['bail', 'required', 'digits_between:10,15', 'starts_with:0', new NotServerNumber()],
            'blacklist_check' => ['boolean'],
        ];
    }
}
