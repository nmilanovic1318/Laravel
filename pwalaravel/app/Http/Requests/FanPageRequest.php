<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FanPageRequest extends FormRequest
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
            'name'=>'required|string',
            'type'=>'required',
            'body'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Morate uneti ime za Vašu fan stranicu.',
            'type.required' => 'Morate odabrati tip fan stranice!',
            'body.required' => 'Morate ukucati kratak opis za Vašu fan stranicu'
        ];
    }
}
