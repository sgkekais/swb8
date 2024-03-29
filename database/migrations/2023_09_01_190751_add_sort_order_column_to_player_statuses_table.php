<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSortOrderColumnToPlayerStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('player_statuses', function (Blueprint $table) {
            //
            $table->integer('sort_order')->after('display_in_squad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('player_statuses', function (Blueprint $table) {
            //
            $table->dropColumn('sort_order');
        });
    }
}
