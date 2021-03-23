<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'date_of_birth' => 'date|before:13 years ago',
            'image'=>'max:4999'
        ];
    }
    public function messages(){
        return[
            'name.required'=> 'Morate uneti nešto u polje za ime.',
            'surname.required'=>'Morate uneti nešto u polje za prezime.',
            'email.required'=>'Morate uneti validnu email adresu u polje za email adresu.',
            'email.email'=>'Morate uneti validnu email adresu u polje za email adresu.',
            'date_of_birth.date'=>'Morate uneti validan datum koji je bar pre 13 godina.',
            'image.size'=>'Molimo unesite fajl veličine ispod 5 MB.'
        ];
    }
}
