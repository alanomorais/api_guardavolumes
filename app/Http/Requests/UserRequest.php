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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()){
            case 'GET':
            case 'DELETE':{
                return[
                    'id' => 'requeired|exists:post,id'
                ];

            }
            case 'POST': {
                return [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['string', 'min:8', 'confirmed'],
                ];

            }
            case 'PUT':
            case 'PATCH': {
                return[
                    'id' => 'requeired|exists:post,id',
                    'nome' => 'required|min:2'
                ];
            }

        }

    }
}
