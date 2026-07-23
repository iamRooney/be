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
        Schema::create('companies', function (Blueprint $table) {

            $table->id();

            $table->foreignId('country_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('state_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('city_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('logo')->nullable();

            $table->string('email')->unique();

            $table->string('phone', 20);

            $table->string('website')->nullable();

            $table->string('gst_number')->nullable();

            $table->text('description')->nullable();

            $table->string('address')->nullable();

            $table->integer('years_in_business')->default(0);

            $table->string('annual_turnover')->nullable();

            $table->integer('staff_count')->default(0);

            $table->integer('response_rate')->default(100);

            $table->boolean('verified')->default(false);

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
