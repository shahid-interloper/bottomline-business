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
        Schema::create('category_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('added_by')->nullable();//added by belongs to user with user_id
            $table->unsignedBigInteger('updated_by')->nullable();//updated by belongs to user with user_id
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('order')->nullable();
            $table->string('link')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('category_types');
    }
};
