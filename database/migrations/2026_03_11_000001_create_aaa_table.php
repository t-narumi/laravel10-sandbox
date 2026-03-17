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
        Schema::create('aaa', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Illuminate\Support\Facades\Log::info('Created aaa table');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aaa');
        Illuminate\Support\Facades\Log::info('Dropped aaa table');
    }
};
