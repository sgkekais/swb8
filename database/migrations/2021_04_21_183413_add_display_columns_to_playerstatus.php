<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDisplayColumnsToPlayerstatus extends Migration
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
            $table->boolean('display_in_polls')->default(0)->after('can_play');
            $table->boolean('display_in_squad')->default(0)->after('display_in_polls');
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
            $table->dropColumn('display_in_polls');
            $table->dropColumn('display_in_squad');
        });
    }
}
