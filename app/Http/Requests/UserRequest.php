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
        $user = auth()->user();
        if($user->role === "ADMINISTRATOR"){
            return [
                'name'=> 'required|min:3',
                //'email'=>'required|email|unique:users,email,' . ('id'),
                'phone' => 'required',
                'mobile_phone' => 'required',
                'postal_code' => 'required',
                'street' => 'required|min:3',
                'house_number' => 'required',
                'complement' => '',
                'neighborhood' => 'required|min:3',
                'city'=> 'required',
                'state' => 'required|min:2',
                'country' => 'required|min:2'
            ];
        }else{
            return [
                'name'=> 'required|min:3',
                'email'=>'required|email|unique:users,email,' . auth()->id(),
                'phone' => 'required',
                'mobile_phone' => 'required',
                'postal_code' => 'required',
                'street' => 'required|min:3',
                'house_number' => 'required',
                'complement' => '',
                'neighborhood' => 'required|min:3',
                'city'=> 'required',
                'state' => 'required|min:2',
                'country' => 'required|min:2'
            ];
        }

    }
    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório!',
            'min' => 'Campo deve ter no mínimo :min caracteres!',
            'max'=> 'Campo deve ter no máximo :max caracteres!',
            'unique'=> 'E-mail já cadastrado em nossa base!',
        ];
    }
}
