<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            // ✅ SINGLE SOURCE OF TRUTH (BEST PRACTICE)
            $table->string('approval_status')
                ->default('pending')
                ->after('status');
                // pending | approved | rejected

            // optional: admin feedback
            $table->text('admin_note')->nullable()->after('approval_status');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn(['approval_status', 'admin_note']);
        });
    }
};