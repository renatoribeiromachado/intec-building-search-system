<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartAndEndFieldInAssociatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('associates', function (Blueprint $table) {
            $table->date('data_filter_starts_at')->nullable()->after('company_date_birth');
            $table->date('data_filter_ends_at')->nullable()->after('data_filter_starts_at');
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
            $table->dropColumn('data_filter_starts_at');
            $table->dropColumn('data_filter_ends_at');
        });
    }
}
