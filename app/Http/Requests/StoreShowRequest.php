<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'start'=>'datetime|required',
            'end'=>'datetime|required',
            'movie_id'=>'required|exists:movies,id|uuid',
            'room_id'=>'required|exists:rooms,id',
            'price'=>'required|between:0,999.99'
        ];
    }
}
