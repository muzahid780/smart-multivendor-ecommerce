<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn([
                'customer_name',
                'customer_email',
                'address',
                'status',
                'admin_commission'
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->text('address')->nullable();
            $table->string('status')->default('pending');
            $table->decimal('admin_commission', 10, 2)->default(0);
        });
    }
};