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
        Schema::create('product_transfers', function (Blueprint $table) {
            
            $table->id();
            
            $table->unsignedBigInteger('previous_stock');
            $table->foreign('previous_stock')->references('id')->on('product_stock')->onDelete('cascade');

            $table->unsignedBigInteger('new_stock');
            $table->foreign('new_stock')->references('id')->on('product_stock')->onDelete('cascade');

            $table->text('comment')->nullable();

            $table->boolean('active')->default('true');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_transfers');
    }
};
