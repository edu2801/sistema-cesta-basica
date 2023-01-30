<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostumersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costumers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('rg')->nullable();
            $table->string('cpf')->unique()->nullable();
            $table->string('schooling')->nullable();
            $table->string('occupation')->nullable();
            $table->string('salary')->nullable();
            // futuramente, se necessário, é possível criar umatabela de benefícios
            // e outra para relacionar os benefícios com o cliente
            $table->integer('cadastro_unico')->default(0);
            $table->integer('bolsa_familia')->default(0);
            $table->integer('prestacao_continuada')->default(0);
            $table->integer('renda_cidada')->default(0);
            $table->integer('cesta_basica')->default(0);
            $table->float('family_income')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('costumers');
    }
}
