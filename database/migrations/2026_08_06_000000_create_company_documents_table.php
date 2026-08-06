<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_documents', function (Blueprint $table) {

            $table->id();

            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnDelete();

            // What kind of legal/identity document this is.
            $table->string('type');

            // Original filename — display only, never used to build a
            // filesystem path (the stored file uses a random name).
            $table->string('original_name');

            // Path on the *private* 'local' disk (storage/app/private),
            // which is never web-accessible.
            $table->string('file_path');

            // Real, server-detected MIME type — trusted over anything
            // the client claims.
            $table->string('mime_type');

            $table->unsignedBigInteger('size');

            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            // Rejection reason / review notes from the admin.
            $table->text('notes')->nullable();

            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('admins')
                ->nullOnDelete();

            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_documents');
    }
};
