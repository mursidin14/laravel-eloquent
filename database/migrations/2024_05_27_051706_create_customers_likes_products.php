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
        Schema::create('customers_likes_products', function (Blueprint $table) {
            $table->string('customer_id', 100)->nullable(false);
            $table->string('product_id', 100)->nullable(false);
            $table->primary(['customer_id', 'product_id']);
            $table->foreign('customer_id')->on('customers')->references('id');
            $table->foreign('product_id')->on('products')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers_likes_products');
    }
};