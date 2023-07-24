<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_id')->nullable();
            $table->foreignId('position_id')->nullable();
            $table->foreignId('company_id')->nullable();
            $table->string('name')->nullable();
            $table->string('ddd')->nullable();
            $table->string('main_phone', 50)->nullable();
            $table->string('ddd_fax')->nullable();
            $table->string('fax', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('ddd_two', 5)->nullable();
            $table->string('phone_two', 20)->nullable();
            $table->string('ddd_three', 5)->nullable();
            $table->string('phone_three', 20)->nullable();
            $table->string('ddd_four', 5)->nullable();
            $table->string('phone_four', 20)->nullable();
            $table->string('phone_type_one')->nullable();
            $table->string('phone_type_two')->nullable();
            $table->string('phone_type_three')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('work_id')->references('id')->on('works');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('contacts');
    }
}
