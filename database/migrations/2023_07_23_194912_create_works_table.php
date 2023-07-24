<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phase_id')->nullable();
            $table->foreignId('stage_id')->nullable();
            $table->foreignId('segment_id')->nullable();
            $table->foreignId('segment_sub_type_id')->nullable();
            $table->string('old_code')->nullable();
            $table->date('last_review')->nullable();
            $table->string('name')->nullable(); // projeto
            $table->decimal('price', 10, 2)->nullable();

            $table->string('address', 100)->nullable();
            $table->string('number')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->char('state_acronym', 2)->nullable();
            $table->string('zip_code')->nullable();

            $table->date('started_at')->nullable();
            $table->date('ends_at')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('phase_id')->references('id')->on('phases');
            $table->foreign('stage_id')->references('id')->on('stages');
            $table->foreign('segment_id')->references('id')->on('segments');
            $table->foreign('segment_sub_type_id')->references('id')->on('segment_sub_types');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('works');
    }
}
