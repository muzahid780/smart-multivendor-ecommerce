<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            if (!Schema::hasColumn('orders', 'customer_name')) {
                $table->string('customer_name')->nullable()->after('id');
            }

            if (!Schema::hasColumn('orders', 'customer_email')) {
                $table->string('customer_email')->nullable();
            }

            if (!Schema::hasColumn('orders', 'phone')) {
                $table->string('phone')->nullable();
            }

            if (!Schema::hasColumn('orders', 'address')) {
                $table->text('address')->nullable();
            }

            if (!Schema::hasColumn('orders', 'total_price')) {
                $table->decimal('total_price', 10, 2)->default(0);
            }

            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method')->default('Cash On Delivery');
            }

            if (!Schema::hasColumn('orders', 'status')) {
                $table->string('status')->default('pending');
            }

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn([
                'customer_name',
                'customer_email',
                'phone',
                'address',
                'total_price',
                'payment_method',
                'status'
            ]);

        });
    }
};