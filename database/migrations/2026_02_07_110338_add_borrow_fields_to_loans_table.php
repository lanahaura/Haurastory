<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->string('borrower_name')->nullable()->after('user_id');
            $table->string('borrower_phone')->nullable()->after('borrower_name');
            $table->date('borrowed_at')->nullable()->change(); // kalau sudah ada, biarkan
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn(['borrower_name', 'borrower_phone']);
        });
    }
};
