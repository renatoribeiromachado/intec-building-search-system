<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociateStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associate_state', function (Blueprint $table) {
            $table->foreignId('associate_id');
            $table->foreignId('state_id');
            $table->primary(['associate_id', 'state_id']);

            $table->foreign('associate_id')->references('id')->on('associates');
            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associate_state');
    }
}
