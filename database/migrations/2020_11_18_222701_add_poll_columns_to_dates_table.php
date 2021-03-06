<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPollColumnsToDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dates', function (Blueprint $table) {
            //
            $table->date('poll_begins')->nullable();
            $table->date('poll_ends')->nullable();
            $table->boolean('poll_is_open')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dates', function (Blueprint $table) {
            //
            $table->dropColumn([
               'poll_begins',
               'poll_ends',
               'poll_is_open'
            ]);
        });
    }
}
