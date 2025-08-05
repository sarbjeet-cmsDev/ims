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
        Schema::create('customer_exports', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->default('customer-export');
            $table->string('file_path')->nullable();
            $table->enum('status', ['pending', 'running', 'finished', 'failed'])->default('pending');
            $table->text('error')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_exports');
    }
};
