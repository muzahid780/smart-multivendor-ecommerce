<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            // Customer Info
            $table->string('customer_name');
            $table->string('customer_email');

            // Product Relation
            $table->foreignId('product_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Order Details
            $table->integer('quantity')->default(1);

            $table->decimal('total_price', 10, 2);

            // Order Status
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};