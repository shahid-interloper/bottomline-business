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
        Schema::create('variations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
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
            $table->longText('description')->nullable();
            $table->longText('seodata')->nullable();
            $table->longText('metadata')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('in_store')->default(false);
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variations');
    }
};
