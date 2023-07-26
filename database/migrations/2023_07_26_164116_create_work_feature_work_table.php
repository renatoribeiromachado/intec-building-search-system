<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkFeatureWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_feature_work', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_id');
            $table->foreignId('work_feature_id');

            $table->foreign('work_id')->references('id')->on('works');
            $table->foreign('work_feature_id')->references('id')->on('work_features');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_feature_work');
    }
}
