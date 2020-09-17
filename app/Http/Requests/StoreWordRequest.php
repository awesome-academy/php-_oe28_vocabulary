<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreWordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'word' => 'bail|required|string',
            'type' => 'bail|required',
            'meaning' => 'bail|required|string',
            'note' => 'string',
        ];
    }
}
