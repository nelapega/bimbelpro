
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Periksa apakah kolom role sudah tersedia
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('tutor');
            });
        }
    }

    public function down(): void
    {
        // Migration perbaikan ini tidak menghapus kolom.
        // Tujuannya menjaga struktur database tetap aman.
    }
};
