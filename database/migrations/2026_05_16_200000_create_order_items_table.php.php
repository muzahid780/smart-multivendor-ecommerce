<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {

            $table->id();

            // ================= RELATIONS =================

            // Order
            $table->foreignId('order_id')
                ->constrained()
                ->onDelete('cascade');

            // Product
            $table->foreignId('product_id')
                ->constrained()
                ->onDelete('cascade');

            // Vendor (IMPORTANT FIX HERE)
            $table->foreignId('vendor_id')
                ->nullable()
                ->constrained('users')   // 👈 FIXED (vendors table না থাকলে users use করো)
                ->nullOnDelete();

            // ================= ITEM DATA =================
            $table->unsignedInteger('quantity');
            $table->decimal('price', 10, 2)->default(0);

            $table->timestamps();

            // ================= INDEX =================
            $table->index(['order_id']);
            $table->index(['product_id']);
            $table->index(['vendor_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};