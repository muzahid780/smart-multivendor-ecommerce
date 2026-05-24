<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
     //Run the migrations.
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            // category image
            $table->string('image')->nullable();

            // 1 = active, 0 = inactive
            $table->boolean('status')->default(1);

            $table->timestamps();

            //performance boost for filtering
            $table->index('status');
        });
    }

     //Reverse the migrations.

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};