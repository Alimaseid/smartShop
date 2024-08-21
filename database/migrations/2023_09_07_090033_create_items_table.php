<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('category')->nullable();
            $table->string('quantity')->nullable();
            $table->string('item_class')->nullable();
            $table->string('cost_price')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('reorder_level')->nullable();
            $table->string('retail_price')->nullable();
            $table->string('whole_sale_price')->nullable();
            $table->string('model')->nullable();
            $table->string('unit')->nullable();
            $table->string('weight')->nullable();
            $table->string('dimension')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('part_number')->nullable();
            $table->string('item_number')->nullable();
            $table->string('image')->nullable();;
            $table->string('supplier_name')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('bar_code')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
