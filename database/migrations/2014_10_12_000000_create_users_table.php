<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('sex')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('dob')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('key')->nullable();
            $table->string('interested_in')->nullable();
            $table->string('martial_status')->nullable();
            $table->string('avatar')->nullable();
            $table->string('cover_avatar')->nullable();
            $table->string('profession')->nullable();
            $table->string('company_name')->nullable();
            $table->string('profession_title')->nullable();
            $table->string('profession_start_date')->nullable();
            $table->string('profession_end_date')->nullable();
            $table->string('education')->nullable();
            $table->string('university_name')->nullable();
            $table->string('education_start_date')->nullable();
            $table->string('education_end_date')->nullable();
            $table->boolean('email_verified')->default(0);
            $table->string('verified_token')->nullable();
            $table->string('status')->default(0);
            $table->string('login_count')->default(0);

            $table->timestamp('email_verified_at')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
