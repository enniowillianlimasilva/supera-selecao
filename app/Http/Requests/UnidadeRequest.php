<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeRequest extends FormRequest
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
            'logomarca' => 'required|mimes:jpeg,jpg,png,gif',
            'empresa_id' => 'required',
            'nome' => 'required|max:200',
            'estado_id' => 'required',
            'cidade_id' => 'required',
            'tipo' => 'required',
            'email' => 'required|email',
            'status' => 'required',
        ];
    }
}
