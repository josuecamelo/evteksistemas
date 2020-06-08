<?php

namespace App;

use Carbon\Carbon;
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

    public function getDataNascAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['data_nasc'])->format('d/m/Y');
    }

    public function setDataNascAttribute($value){
        $this->attributes['data_nasc'] = \DateTime::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function setCpfAttribute($value){
        $this->attributes['cpf'] = $this->removerPontuacoes($value);
    }

    public function setCepAttribute($value){
        $this->attributes['cep'] = $this->removerPontuacoes($value);
    }

    public function getResults($data, $total)
    {
        $order = $data['order'];

        return $this->where(function ($query) use ($data) {
             if (isset($data['filter'])) {
                 $filter = $data['filter'];
                 $query->whereRaw('LOWER(`nome`) LIKE ? ',['%'.trim(strtolower($filter)).'%']);
                    //->orWhere('nome', 'LIKE', "%{$filter}%");
             }
        })
        ->orderBy('nome', $order)
        ->paginate($total);
    }

    protected function removerPontuacoes($valor){
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        return $valor;
    }
}
