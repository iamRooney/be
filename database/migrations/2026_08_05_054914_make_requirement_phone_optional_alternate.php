<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The buyer's contact number is already available to a seller via the
 * buyer's account (users.phone) once a requirement is accepted — see
 * Requirement::buyer(). Asking for a number again on the RFQ form was
 * redundant, so this repurposes the column into an optional "alternate"
 * number a buyer can leave in case their main number doesn't pick up.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('requirements', function (Blueprint $table) {
            $table->renameColumn('phone', 'alternate_phone');
        });

        Schema::table('requirements', function (Blueprint $table) {
            $table->string('alternate_phone')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('requirements', function (Blueprint $table) {
            $table->string('alternate_phone')->nullable(false)->change();
        });

        Schema::table('requirements', function (Blueprint $table) {
            $table->renameColumn('alternate_phone', 'phone');
        });
    }
};
