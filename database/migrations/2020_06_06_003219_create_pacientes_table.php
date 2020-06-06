<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('cpf', 11)->unique();
            $table->string('nome', 100);
            $table->string('rg', 20);
            $table->string('cartao_sus', 30);
            $table->string('sexo', 10);
            $table->string('data_nasc');
            $table->string('nome_mae', 100);
            $table->string('telefone', 11);
            $table->string('cep', 8);
            $table->string('logradouro', 255);
            $table->string('numero', 15)->default('S/N');
            $table->string('quadra', 20);
            $table->string('lote', 20);
            $table->string('complemento', 150);
            $table->string('bairro', 100);
            $table->string('cidade', 200);
            $table->char('uf', 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
