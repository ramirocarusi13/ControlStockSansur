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
        Schema::create('kitchen_stock', function (Blueprint $table) {
            
            $table->id();

            $table->unsignedBigInteger('kitchen_id');
            $table->foreign('kitchen_id')->references('id')->on('kitchens')->onDelete('cascade');

            $table->unsignedBigInteger('stock');
            
            $table->string('location');

            $table->string('status');

            $table->boolean('active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kitchen_stock');
    }
};
