<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaUpdateRequest extends FormRequest
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
            'logomarca' => 'mimes:jpeg,jpg,png,gif',
            'cnpj' => 'required|cnpj|unique:empresas,id',
            'razao_social' => 'required|max:200',
            'nome_fantasia' => 'required|max:200',
            'email' => 'required|email',
            'status' => 'required',
        ];
    }
}
