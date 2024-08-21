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
        Schema::create('issuings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from');
            $table->string('issuing_no');
            $table->string('requested_by');
            $table->date('date');
            $table->date('total_quantity')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issuings');
    }
};
