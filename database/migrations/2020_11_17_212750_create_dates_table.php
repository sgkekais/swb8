<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('date_type_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('location_id')->constrained()->onUpdate('cascade')->onDelete('restrict')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('note')->nullable();
            $table->boolean('published')->default(0);
            $table->boolean('cancelled')->default(0);
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
        Schema::dropIfExists('dates');
    }
}
