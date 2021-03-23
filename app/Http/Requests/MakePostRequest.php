<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakePostRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'body' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'body.required' => 'Morate uneti tekst u polje za post!',

        ];
    }
}