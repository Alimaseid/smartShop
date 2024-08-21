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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->foreignId('store_id');
            $table->string('invoice_no');
            $table->date('date')->nullable();
            $table->string('sales_type');
            $table->string('sub_total');
            $table->string('discount')->nullable();
            $table->string('vat')->nullable();
            $table->string('total');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
