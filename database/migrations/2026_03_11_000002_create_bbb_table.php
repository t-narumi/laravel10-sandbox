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
        Schema::create('bbb', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Illuminate\Support\Facades\Log::info('Created bbb table');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bbb');
        Illuminate\Support\Facades\Log::info('Dropped bbb table');
    }
};
