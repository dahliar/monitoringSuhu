<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $types = [
        'Suhu Panas',
        'Suhu Dingin',
        'Suhu Ruangan',
    ];

    public function up(): void
    {
        if (! Schema::hasTable('rooms') || ! Schema::hasColumn('rooms', 'type')) {
            return;
        }

        DB::table('rooms')
            ->whereNotIn('type', $this->types)
            ->update(['type' => 'Suhu Ruangan']);

        Schema::table('rooms', function (Blueprint $table) {
            $table->enum('type', $this->types)->default('Suhu Ruangan')->change();
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('rooms') || ! Schema::hasColumn('rooms', 'type')) {
            return;
        }

        Schema::table('rooms', function (Blueprint $table) {
            $table->string('type')->change();
        });
    }
};
