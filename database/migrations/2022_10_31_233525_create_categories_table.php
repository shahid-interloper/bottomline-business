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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('added_by')->nullable();//added by belongs to user with user_id
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('category_type_id')->nullable();//category_type_id by belongs to category type
            $table->unsignedBigInteger('parent_id')->nullable();//added by belongs to user with user_id
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('icon')->nullable();
            $table->longText('metadata')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('visits')->default(0);
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
        Schema::dropIfExists('categories');
    }
};
