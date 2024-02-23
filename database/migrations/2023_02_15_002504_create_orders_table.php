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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('is_guest')->default(false);
            $table->string('order_number')->nullable();
            $table->decimal('sub_total', 8, 2)->nullable();
            $table->string('coupon_code')->nullable();
            $table->decimal('shipping_charges', 8, 2)->nullable();
            $table->decimal('tax', 8, 2)->nullable();
            $table->decimal('total', 8, 2)->nullable();
            $table->longText('delivery_details')->nullable();
            $table->string('payment_method')->nullable();
            $table->longText('payment_details')->nullable();
            $table->longText('customer_details')->nullable();
            $table->longText('metadata')->nullable();
            $table->string('status')->default('new');
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
        Schema::dropIfExists('orders');
    }
};
