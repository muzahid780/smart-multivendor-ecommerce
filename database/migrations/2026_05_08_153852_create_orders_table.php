<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            // ================= USER =================
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // ================= CUSTOMER INFO =================
            $table->string('phone');
            $table->text('shipping_address');

            // ================= ORDER TOTAL =================
            $table->decimal('total_price', 10, 2)->default(0);

            // ================= PAYMENT =================
            $table->string('payment_method')
                ->default('cash_on_delivery');

            $table->string('payment_status')
                ->default('pending'); 
                // pending | paid | failed

            // ================= ORDER STATUS =================
            $table->string('order_status')
                ->default('pending');
                // pending | processing | completed | cancelled

            // ================= INDEX (FAST QUERY) =================
            $table->index('user_id');
            $table->index('order_status');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};