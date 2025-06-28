<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHousingDetailsToHabitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('habitation', function (Blueprint $table) {
            $table->string('type')->nullable()->after('ownership');
            $table->string('financing_details')->nullable()->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('habitation', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('financing_details');
        });
    }
}