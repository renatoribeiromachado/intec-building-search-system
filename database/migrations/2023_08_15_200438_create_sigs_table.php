<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sigs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('associate_id');
            $table->foreignId('work_id');
            $table->timestamp('appointment_date')->nullable();
            $table->string('priority', 50)->nullable();
            $table->string('status', 100)->nullable();
            $table->longText('notes')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('associate_id')->references('id')->on('associates');
            $table->foreign('work_id')->references('id')->on('works');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sigs');
    }
}
