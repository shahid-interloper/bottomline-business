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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('added_by')->nullable();//added by belongs to user with user_id
            $table->unsignedBigInteger('updated_by')->nullable();//added by belongs to user with user_id
            $table->unsignedBigInteger('page_id')->nullable();
            $table->longText('headings')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->longText('buttons')->nullable();
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
        Schema::dropIfExists('banners');
    }
};
