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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('thumbnail')->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->decimal('discount_amount', 8, 2)->default(0);
            $table->enum('discount_type', ['fixed', 'percent'])->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('stock_alert_quantity')->default(0);
            $table->string('sku')->nullable();
            $table->integer('sold')->default(0);
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('related_products')->nullable();
            $table->longText('seodata')->nullable();
            $table->longText('metadata')->nullable();
            $table->enum('type', ['simple', 'varition'])->default('simple');
            $table->boolean('is_sample')->default(false);
            $table->boolean('is_onsale')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('in_store')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['added_by', 'brand_id']);
            $table->index(['name']);
            $table->index(['price', 'discount_amount']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
