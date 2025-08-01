<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('company_name');
            $table->string('contact_person');
            $table->enum('customer_type', ['Individual', 'Business', 'Reseller']);
            $table->string('tax_id');
            $table->enum('status', ['Active', 'Inactive', 'Prospective']);
            $table->text('notes')->nullable();
            $table->decimal('credit_limit', 12, 2)->default(0);
            $table->decimal('total_purchases', 12, 2)->default(0);
            $table->timestamp('last_purchase_at')->nullable();
            $table->timestamp('registered_at')->useCurrent();
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
