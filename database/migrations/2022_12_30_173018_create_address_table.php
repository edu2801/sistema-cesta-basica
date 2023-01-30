<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->foreignId('costumer_id')->constrained('costumers')->onDelete('cascade');
            $table->string('street')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('number')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('cep')->nullable();
            $table->string('complement')->nullable();
            $table->string('reference')->nullable();
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
        Schema::dropIfExists('address');
    }
}
