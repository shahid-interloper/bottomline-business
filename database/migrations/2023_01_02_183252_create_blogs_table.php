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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('added_by')->nullable(); //added by belongs to user with user_id
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('icon')->nullable();
            $table->longText('meta_data')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(1);
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
        Schema::dropIfExists('blogs');
    }
};
