<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('costumer_id')->constrained('costumers')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('relationship')->nullable();
            $table->integer('age')->nullable();
            $table->string('occupation')->nullable();
            $table->float('salary')->nullable();
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
        Schema::dropIfExists('family_group');
    }
}
