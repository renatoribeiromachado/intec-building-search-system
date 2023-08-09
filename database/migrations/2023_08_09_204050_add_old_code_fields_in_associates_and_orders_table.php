<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOldCodeFieldsInAssociatesAndOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('associates', function (Blueprint $table) {
            $table->string('old_code', 30)->nullable()->after('salesperson_id');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('old_code', 30)->nullable()->after('plan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('associates', function (Blueprint $table) {
            $table->dropColumn('old_code');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('old_code');
        });
    }
}
