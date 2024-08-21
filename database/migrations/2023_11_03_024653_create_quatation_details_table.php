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
        Schema::create('quatation_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_quotation_id');
            $table->foreignId('item_id');
            $table->string('unit');
            $table->string('unit_price');
            $table->string('quantity');
            $table->string('amount');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quatation_details');
    }
};
