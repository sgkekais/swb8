<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('date_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('match_type_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->tinyInteger('matchweek')->nullable();
            $table->unsignedBigInteger('team_home')->nullable();
            $table->unsignedBigInteger('team_away')->nullable();
            $table->tinyInteger('goals_home')->nullable();
            $table->tinyInteger('goals_home_ht')->nullable();
            $table->tinyInteger('goals_home_pen')->nullable();
            $table->tinyInteger('goals_home_rated')->nullable();
            $table->tinyInteger('goals_away')->nullable();
            $table->tinyInteger('goals_away_ht')->nullable();
            $table->tinyInteger('goals_away_pen')->nullable();
            $table->tinyInteger('goals_away_rated')->nullable();
            $table->text('match_details')->nullable();
            $table->unsignedBigInteger('rescheduled_to_fixture_id')->nullable();
            $table->unsignedBigInteger('rescheduled_by_team')->nullable();
            $table->string('reschedule_reason')->nullable();
            $table->boolean('published')->default(0);
            $table->boolean('cancelled')->default(0);
            $table->timestamps();

            // Foreign Keys
            $table->foreign('team_home')
                ->references('id')->on('clubs')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('team_away')
                ->references('id')->on('clubs')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('rescheduled_to_fixture_id')
                ->references('id')->on('matches')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('rescheduled_by_team')
                ->references('id')->on('clubs')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
