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
        Schema::create('ccc', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Illuminate\Support\Facades\Log::info('Created ccc table');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ccc');
        Illuminate\Support\Facades\Log::info('Dropped ccc table');
    }
};
