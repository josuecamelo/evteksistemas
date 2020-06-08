<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePacienteFormRequest extends FormRequest
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
        $id = $this->segment(4);
        return [
            'cpf' => "required|unique:pacientes,cpf,{$id},id",
            'nome'=> "required|min:5|max:100",
            'rg' => "required",
            'sexo' => "required|in:Masculino,Feminino",
            'data_nasc' => "required",
            'nome_mae' => "required",
            'telefone' => "required",
            'cep' => "required",
            'logradouro' => "required",
            'quadra' => "required",
            'lote' => "required",
            'bairro'=> "required",
            'cidade'=> "required",
            'uf' => "required|min:2"
            //'imagem'         => 'image',
        ];
    }

    public function messages(){
        return [
            'cpf.required' => 'Informe o CPF',
            'sexo.required' => 'Informe o Sexo',
            'sexo.in' => "Informe Masculino ou Feminino",
            'rg.required' => 'Informe o RG',
            'data_nasc.required' => 'Informe a Data de Nascimento',
            'nome_mae.required' => 'Informe o Nome da Mãe',
            'telefone.required' => 'Informe o Telefone',
            'cep.required' => 'Informe o Telefone',
            'logradouro.required' => 'Informe o Logradouro',
            'quadra.required' => 'Informe o Quadra',
            'lote.required' => 'Informe o Lote',
            'bairro.required' => 'Informe o Bairro',
            'cidade.required' => 'Informe a Cidade',
            'uf.required' => 'Informe a UF',
        ];
    }
}
