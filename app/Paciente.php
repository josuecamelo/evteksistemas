<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use SoftDeletes;

    protected $table = 'pacientes';
    protected $fillable = [
        'cpf',
        'nome',
        'rg',
        'cartao_sus',
        'sexo',
        'data_nasc',
        'nome_mae',
        'telefone',
        'cep',
        'logradouro',
        'numero',
        'quadra',
        'lote',
        'complemento',
        'bairro',
        'cidade',
        'uf'
    ];

    public function getResults($data, $total)
    {
        return $this
            ->orderBy('id', 'DESC')
            ->paginate($total);
    }
}
