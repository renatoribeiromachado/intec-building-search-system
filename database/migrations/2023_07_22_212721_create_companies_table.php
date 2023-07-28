<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_segment_id')->nullable();
            $table->foreignId('researcher_id')->nullable();
            $table->foreignId('activity_field_id')->nullable();
            $table->string('company_name'); // razao social
            $table->string('trading_name')->nullable();
            $table->string('minified_name')->nullable();
            $table->string('trading_name_slug')->nullable();
            $table->string('address', 100)->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('city_registration')->nullable();
            $table->string('state')->nullable();
            $table->string('state_registration')->nullable();
            $table->char('state_acronym', 2)->nullable();
            $table->string('zip_code')->nullable();
            $table->string('phone_one')->nullable();
            // $table->string('phone_two')->nullable();
            // $table->string('mobile')->nullable();
            $table->text('notes')->nullable();
            $table->integer('revision')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('activity_field')->nullable();
            // $table->string('cnpj_validation')->nullable();
            $table->string('primary_email', 50)->nullable();
            $table->string('secondary_email', 50)->nullable();
            $table->string('home_page')->nullable();
            $table->date('last_review')->nullable();
            $table->string('skype')->nullable();
            // $table->string('facebook_fan_page')->nullable();
            // $table->string('twitter_profile_url')->nullable();
            // $table->string('instagram_profile_url')->nullable();
            // $table->string('linkedin_profile_url')->nullable();
            // $table->string('youtube_profile_url')->nullable();
            // $table->string('spotify_profile_url')->nullable();
            $table->string('sponsor')->nullable(); // responsável
            $table->string('sponsor_slug')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_project_owner')->default(false);
            $table->string('image_storage_link')->nullable();
            $table->string('image_public_link')->nullable();
            // $table->boolean('is_legal_entity')->default(false)->comment('0 - Yes, it is | 1 - No, it\'s not ');
            // $table->boolean('is_cnae_regular')->default(true); // classificação nacional de atividades econômicas
            $table->string('register_ip')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('company_segment_id')->references('id')->on('company_segments');
            $table->foreign('researcher_id')->references('id')->on('users');
            $table->foreign('activity_field_id')->references('id')->on('activity_fields');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
