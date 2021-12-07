<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
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
        switch($this->method()){
            case 'GET':
            case 'DELETE':{
                return[
                    'id' => 'requeired|exists:post,id'
                ];
                
            }
            case 'POST': {
                return [
                    'nome' => 'required',
                    'sobrenome',
                    'unidade' => 'required',
                    'enfermaria' => 'required',
                    'leito' => 'required',
                    'acompanhante',
                    'dt_alta',
                    'observacao'
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
