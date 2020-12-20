<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPointMatchColumnToMatchTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_types', function (Blueprint $table) {
            //
            $table->boolean('is_point_match')->default(0)->after('description_short');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('match_types', function (Blueprint $table) {
            //
            $table->dropColumn('is_point_match');
        });
    }
}
