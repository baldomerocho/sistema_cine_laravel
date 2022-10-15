<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
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
            'title'=>'required|string|max:255',
            'tagline'=>'required|string|max:255',
            'original_title'=>'required|string|max:255',
            'video'=>'string|max:2048',
            'status'=>'string|max:50',
            'language'=>'string|max:10',
            'poster_path'=>'required|string|max:100',
            'backdrop_path'=>'required|string|max:100',
            'imdb_id'=>'required|integer|unique:movies',
            'tmdb_id'=>'required|integer|unique:movies',
            'adult'=>'required|boolean',
            'overview'=>'string|max:2048',
        ];
    }
}
