<?php

namespace App\Http\Requests;

use App\Rules\NotInBlackList;
use App\Rules\NotServerNumber;
use App\Rules\ProviderAvailable;
use App\Rules\RateBelowProvider;
use App\Rules\ReceiverAvailable;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransaction extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'blacklist_check' => ['bail', 'sometimes', 'boolean'],
            'provider' => ['bail', 'required', new ProviderAvailable(), new ReceiverAvailable()],
            'sender' => [
                'bail',
                'required',
                'digits_between:10,15',
                'starts_with:0',
                new NotServerNumber(),
                new NotInBlackList($this->blacklist_check)],
            'rate' => ['bail', 'numeric', new RateBelowProvider($this->provider)],
        ];
    }
}
