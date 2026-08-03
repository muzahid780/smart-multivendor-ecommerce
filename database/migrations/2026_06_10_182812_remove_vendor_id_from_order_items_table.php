<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {

            // 1. drop foreign key first (if exists)
            $table->dropForeign(['vendor_id']);

            // 2. then drop column
            $table->dropColumn('vendor_id');
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {

            $table->unsignedBigInteger('vendor_id')->nullable();

            // optional: restore foreign key
            // $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};