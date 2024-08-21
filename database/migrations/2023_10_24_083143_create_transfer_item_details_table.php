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
        Schema::create('transfer_item_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transfer_item_id');
            $table->foreignId('item_id');
            $table->foreignId('item_name');
            $table->foreignId('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_item_details');
    }
};
