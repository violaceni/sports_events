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
            $table->bigIncrements('id');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedBigInteger('first_team_id');
            $table->unsignedBigInteger('second_team_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('type_id');
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
        Schema::dropIfExists('matches');
        $table->foreign('first_team_id')
            ->references('id')
            ->on('teams')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        $table->foreign('second_team_id')
            ->references('id')
            ->on('teams')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        $table->foreign('location_id')
            ->references('id')
            ->on('locations')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        $table->foreign('event_id')
            ->references('id')
            ->on('events')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('type_id')
            ->references('id')
            ->on('types')
            ->onDelete('cascade')
            ->onUpdate('cascade');


    }
}
