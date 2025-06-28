<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToFamilyGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('family_group', function (Blueprint $table) {
            $table->date('birth_date')->nullable()->after('relationship');
            $table->string('income_source')->nullable()->after('age');
            $table->float('income_value')->nullable()->after('income_source');
            $table->string('schooling')->nullable()->after('income_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('family_group', function (Blueprint $table) {
            $table->dropColumn('birth_date');
            $table->dropColumn('income_source');
            $table->dropColumn('income_value');
            $table->dropColumn('schooling');
        });
    }
}