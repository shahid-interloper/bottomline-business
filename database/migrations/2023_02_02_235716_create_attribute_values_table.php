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
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_id')->nullable();
            $table->string('title')->nullable();
            $table->text('value')->nullable();
            $table->decimal('price', 2)->default(0)->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('discount_amount', 8, 2)->default(0);
            $table->enum('discount_type', ['fixed', 'percent'])->nullable();
            $table->string('sku')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('is_active')->default(true);
            $table->longText('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('attribute_id')->references('id')->on('attributes');

            $table->index(['attribute_id', 'title']);
            $table->index(['price']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_values');
    }
};
