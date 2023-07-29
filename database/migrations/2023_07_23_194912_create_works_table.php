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
            $table->decimal('price', 14, 2)->nullable();

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

            $table->integer('revision')->nullable();
            $table->string('start_and_end')->nullable();
            $table->string('total_project_area')->nullable();
            $table->string('cub')->nullable();
            $table->string('quotation_type')->nullable();
            $table->string('coin')->nullable();
            $table->string('investment_standard')->nullable();

            $table->string('tower')->nullable();
            $table->string('house')->nullable();
            $table->string('condominium')->nullable();
            $table->string('floor')->nullable();
            $table->string('apartment_per_floor')->nullable();
            $table->string('bedroom')->nullable();
            $table->string('suite')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('washbasin')->nullable();
            $table->string('living_room')->nullable();
            $table->string('cup_and_kitchen')->nullable();
            $table->string('service_area_terrace_balcony')->nullable();
            $table->string('maid_dependency')->nullable();
            $table->string('total_unities')->nullable();
            $table->string('useful_area')->nullable();
            $table->string('total_area')->nullable();
            $table->string('elevator')->nullable();
            $table->string('garage')->nullable();
            $table->string('coverage')->nullable();
            $table->string('air_conditioner')->nullable();
            $table->string('heating')->nullable();
            $table->string('foundry')->nullable();
            $table->string('frame')->nullable();
            $table->string('completion')->nullable();
            $table->string('facade')->nullable();
            $table->string('status')->nullable();

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
