<?php

use App\Paciente;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Paciente::class, function (Faker $faker) {
    return [
        'cpf' => '00000000000',
        'nome' => $faker->name,
        'rg' => '00000',
        'cartao_sus' => '00000',
        'sexo' => 'Masculino',
        'data_nasc' => $faker->date(),
        'nome_mae' => $faker->name,
        'telefone' => '99999999999',
        'cep' => '75000000',
        'logradouro' => $faker->address,
        'numero' => $faker->numberBetween(1,1000),
        'quadra' => 'QD 1',
        'lote' => 'LT 1',
        'complemento' => 'Perto de Algum Lugar',
        'bairro' => 'Bairro 1',
        'cidade' => $faker->city,
        'uf' => 'GO'
    ];
});
