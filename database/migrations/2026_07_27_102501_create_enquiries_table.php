<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {

            $table->id();

            $table->string('enquiry_number')->unique();

            // Buyer
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Seller Company
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();

            // Listing
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('service_id')->nullable()->constrained()->nullOnDelete();

            $table->text('message');

            $table->enum('status', [
                'open',
                'closed',
            ])->default('open');

            $table->enum('priority', [
                'low',
                'medium',
                'high',
            ])->default('medium');

            $table->timestamps();

            $table->index('status');
            $table->index('priority');
            $table->index('company_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
