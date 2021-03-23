<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'searchUser'=>'required_without:searchPosts',
            'searchPosts'=>'required_without:searchUser'
        ];
    }
    public function messages()
    {
        return[
          'searchUser.required_without'=>'Morate uneti nešto u polje za pretragu!',
          'searchPosts.required_without'=>'Morate uneti nešto u polje za pretragu!'
        ];
    }
}
