<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'old_password'=>'required',
            'new_password'=> 'required|min:8|different:old_password',
            'confirm_password' => 'required|same:new_password'
        ];
    }
    public function messages()
    {
        return [
            'different'=> 'Valor informado para nova senha igual à senha atual!',
            'required' => 'Este campo é obrigatório!',
            'same' => 'A confirmação da senha não corresponde.',
            'min' => 'O campo deve ter no mínimo :min caracteres!'
        ];
    }
}
