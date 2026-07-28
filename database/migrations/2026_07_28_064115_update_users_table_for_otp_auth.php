<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('phone', 20)->unique()->after('name');

            $table->string('profile_image')->nullable()->after('email');

            $table->string('otp', 6)->nullable()->after('password');

            $table->timestamp('otp_expires_at')->nullable()->after('otp');

            $table->timestamp('otp_verified_at')->nullable()->after('otp_expires_at');

            $table->boolean('status')->default(true)->after('otp_verified_at');

            $table->string('password')->nullable()->change();

            $table->string('email')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'phone',
                'profile_image',
                'otp',
                'otp_expires_at',
                'otp_verified_at',
                'status'
            ]);

            $table->string('password')->nullable(false)->change();

            $table->string('email')->nullable(false)->change();
        });
    }
};
