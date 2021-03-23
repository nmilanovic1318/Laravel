<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'password' => 'required|confirmed',
            'email' => 'required|email',
            'date_of_birth' => 'required|date|before:13 years ago'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Polje za ime je obavezno.',
            'surname.required' => 'Polje za prezime je obavezno.',
            'password.required' => 'Polje za šifru je obavezno.',
            'email.required' => 'Polje za e-mail je obavezno.',
            'password.confirmed' => 'Unete šifre se ne poklapaju!',
            'date_of_birth.required' => 'Polje za datum rođenja је obavezno',
            'date_of_birth.before' => 'Morate imati minimum 13 godina da bi se registrovali'
        ];
    }
}
