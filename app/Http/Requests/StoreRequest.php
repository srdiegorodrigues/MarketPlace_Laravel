<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name'=> 'required|min:3',
            'description'=> 'required|min:3',
            'phone'=> 'required',
            'mobile_phone'=> 'required',
            'logo' => 'image',
            'postal_code' => 'required',
            'street' => 'required|min:3',
            'house_number' => 'required',
            'neighborhood' => 'required|min:3',
            'city'=> 'required',
            'state' => 'required|min:2',
            'country' => 'required|min:2'
        ];
    }
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório!',
            'min' => 'O campo deve ter no mínimo :min caracteres!',
            'image' => 'O arquivo não é uma imagem válida!',
            'unique' => 'O nome escolhido para a loja já está sendo utilizado',
        ];
    }
}
