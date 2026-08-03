<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            // 1. first drop foreign key
            $table->dropForeign(['vendor_id']);

            // 2. then drop columns
            $table->dropColumn(['vendor_id', 'is_approved', 'approval_status']);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->unsignedBigInteger('vendor_id')->nullable();

            $table->boolean('is_approved')->default(false);

            $table->string('approval_status')->default('pending');

            // (optional) foreign key back
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};