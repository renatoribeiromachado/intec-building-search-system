<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociateSegmentSubTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associate_segment_sub_type', function (Blueprint $table) {
            $table->foreignId('associate_id');
            $table->foreignId('seg_sub_type_id');
            $table->primary(['associate_id', 'seg_sub_type_id']);

            $table->foreign('associate_id')->references('id')->on('associates');
            $table->foreign('seg_sub_type_id')->references('id')->on('segment_sub_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associate_segment_sub_type');
    }
}
