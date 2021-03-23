<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdRequest extends FormRequest
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
            'type' => 'required',
            'age_group'=>'required',
            'image'=>'max:1999'
        ];
    }

    public function messages()
    {
        return [
            'body.required' => 'Morate napisati nešto u polju za tekst reklame!',
            'type.required' => 'Morate odabrati tip reklame!',
            'image.max' => 'Molimo ubacite sliku ispod 2 MB.',
            'age_group.required'=>'Morate odabrati ciljanu starosnu grupu za Vašu reklamu!'
        ];
    }
}
