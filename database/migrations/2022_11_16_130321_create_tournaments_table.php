<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('user_name');
            $table->bigInteger('tournament_creator_id')->unsigned()->index();
            $table->foreign('tournament_creator_id')->references('id')->on('users')->onUpdate('cascade');
            $table->string('venue');
            $table->string('host_organization');
            $table->integer('winning_point');
            $table->softDeletes();
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
        Schema::dropIfExists('tournaments');
    }
};
