<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->foreignId('plan_id');
            $table->text('work_notes')->nullable();
            $table->string('situation')->nullable();
            $table->date('start_at')->nullable();
            $table->date('ends_at')->nullable();
            $table->decimal('original_price', 14, 2)->nullable();
            $table->decimal('discount', 14, 2)->nullable();
            $table->decimal('final_price', 14, 2)->nullable();
            $table->date('first_due_date')->nullable();
            $table->char('installments', 2)->nullable();
            $table->string('easy_payment_condition')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('plan_id')->references('id')->on('plans');
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
        Schema::dropIfExists('orders');
    }
}
