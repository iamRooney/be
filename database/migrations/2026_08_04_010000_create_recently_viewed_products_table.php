<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recently_viewed_products', function (Blueprint $table) {

            $table->id();

            // Buyer who viewed the product
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->foreignId('product_id')->constrained()->cascadeOnDelete();

            // Re-touched (not re-inserted) on every repeat view so the list
            // naturally sorts most-recent-first without growing duplicates.
            $table->timestamp('viewed_at');

            $table->timestamps();

            $table->unique(['user_id', 'product_id']);
            $table->index('viewed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recently_viewed_products');
    }
};
