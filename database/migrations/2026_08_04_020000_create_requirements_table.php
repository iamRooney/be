<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('requirements', function (Blueprint $table) {

            $table->id();

            $table->string('requirement_number')->unique();

            // Buyer who posted it.
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // What the buyer is sourcing — matching sellers are every company
            // with a product/service listed under this category, computed
            // live (see RequirementController@index) rather than frozen here.
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();

            $table->string('title');
            $table->unsignedInteger('quantity');
            $table->string('unit')->default('Pieces');
            $table->string('phone');

            // 'open' -> visible to matching sellers. First seller to accept
            // wins the order and the rest stop seeing it as open.
            $table->enum('status', ['open', 'accepted', 'closed'])->default('open');

            $table->foreignId('accepted_by_company_id')
                ->nullable()
                ->constrained('companies')
                ->nullOnDelete();

            $table->timestamp('accepted_at')->nullable();

            $table->timestamps();

            $table->index(['category_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('requirements');
    }
};
