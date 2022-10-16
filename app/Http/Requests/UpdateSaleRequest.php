<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSaleRequest extends FormRequest
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
            'show_id'=>'required|exists:shows,id',
            'user_id'=>'required|exists:users,id',
            'consumer_id'=>'required|exists:users,id',
            'currency_id'=>'required|exists:currencies,id',
            'ticket'=>'required|string|max:20',
        ];
    }
}
