<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up(): void {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('phone', 50);
            $table->string('company_name', 255);
            $table->string('contact_person', 255);
            $table->enum('customer_type', ['Individual', 'Business', 'Reseller']);
            $table->string('tax_id', 50);
            $table->enum('status', ['Active', 'Inactive', 'Prospective']);
            $table->text('notes')->nullable();
            $table->decimal('credit_limit', 12, 2)->default(0);
            $table->decimal('total_purchases', 12, 2)->default(0);
            $table->timestamp('last_purchase_at')->nullable();
            $table->timestamp('registered_at')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
