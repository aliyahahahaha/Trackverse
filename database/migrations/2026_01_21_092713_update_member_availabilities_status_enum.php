<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Expand the ENUM to allow both old and new values temporary
        DB::statement("ALTER TABLE member_availabilities MODIFY COLUMN status ENUM('present', 'medical_leave', 'vacation', 'available', 'busy', 'on_leave') NOT NULL DEFAULT 'available'");

        // 2. Map old data to new ones
        DB::table('member_availabilities')->where('status', 'present')->update(['status' => 'available']);
        DB::table('member_availabilities')->where('status', 'medical_leave')->update(['status' => 'busy']);
        DB::table('member_availabilities')->where('status', 'vacation')->update(['status' => 'on_leave']);

        // 3. Finalize with only the new values
        DB::statement("ALTER TABLE member_availabilities MODIFY COLUMN status ENUM('available', 'busy', 'on_leave') NOT NULL DEFAULT 'available'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE member_availabilities MODIFY COLUMN status ENUM('present', 'medical_leave', 'vacation') NOT NULL DEFAULT 'present'");
    }
};
