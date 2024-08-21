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
        Schema::create('sales_quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->date('date');
            $table->date('expiration_date')->nullable();
            $table->string('invoice_no');
            $table->string('payment_term')->nullable();
            $table->date('due_date')->nullable();
            $table->string('sub_total');
            $table->string('discount')->nullable();
            $table->string('vat')->nullable();
            $table->string('total');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_quotations');
    }
};
