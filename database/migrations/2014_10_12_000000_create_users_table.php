<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('company_name')->nullable();
            $table->text('address')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('phone_number')->nullable();
            $table->string('mobile')->nullable();
            $table->string('image')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->enum('gender',['male', 'female', 'other'])->nullable();
            $table->boolean('email_notification_active')->default(false);
            $table->boolean('sms_notification_active')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('display_name')->nullable();
            $table->string('timezone')->nullable()->default('UTC');
            $table->string('password');
            $table->text('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_online')->nullable()->default(false);
            $table->boolean('is_available')->nullable()->default(true);
            $table->boolean('is_verified_driver')->nullable()->default(false);
            $table->longText('metadata')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
};
