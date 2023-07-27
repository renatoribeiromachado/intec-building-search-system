<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityFieldWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_field_work', function (Blueprint $table) {
            $table->foreignId('activity_field_id');
            $table->foreignId('work_id');
            $table->foreignId('company_id');

            $table->foreign('activity_field_id')->references('id')->on('activity_fields');
            $table->foreign('work_id')->references('id')->on('works');
            $table->foreign('company_id')->references('id')->on('companies');

            $table->primary(['activity_field_id', 'work_id', 'company_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_field_work');
    }
}
