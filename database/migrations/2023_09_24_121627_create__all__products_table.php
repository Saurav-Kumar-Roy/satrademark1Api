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
        Schema::create('_all__products', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Price');
            $table->string('Image');
            $table->string('Exclusive');
            $table->string('Available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_all__products');
    }
};
