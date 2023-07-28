<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_work', function (Blueprint $table) {
            $table->foreignId('contact_id');
            $table->foreignId('work_id');
            $table->foreignId('company_id');

            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('work_id')->references('id')->on('works');
            $table->foreign('company_id')->references('id')->on('companies');

            $table->primary(['contact_id', 'work_id', 'company_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_work');
    }
}
