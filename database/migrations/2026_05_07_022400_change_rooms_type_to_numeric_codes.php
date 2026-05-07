<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $labelsToCodes = [
        'Suhu Panas' => 1,
        'Suhu Dingin' => 2,
        'Suhu Ruangan' => 3,
    ];

    public function up(): void
    {
        if (! Schema::hasTable('rooms') || ! Schema::hasColumn('rooms', 'type')) {
            return;
        }

        Schema::table('rooms', function (Blueprint $table) {
            $table->string('type')->default('3')->change();
        });

        foreach ($this->labelsToCodes as $label => $code) {
            DB::table('rooms')->where('type', $label)->update(['type' => (string) $code]);
        }

        DB::table('rooms')
            ->whereNotIn('type', ['1', '2', '3'])
            ->update(['type' => '3']);

        Schema::table('rooms', function (Blueprint $table) {
            $table->unsignedTinyInteger('type')->default(3)->change();
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('rooms') || ! Schema::hasColumn('rooms', 'type')) {
            return;
        }

        Schema::table('rooms', function (Blueprint $table) {
            $table->string('type')->default('Suhu Ruangan')->change();
        });

        foreach (array_flip($this->labelsToCodes) as $code => $label) {
            DB::table('rooms')->where('type', (string) $code)->update(['type' => $label]);
        }

        Schema::table('rooms', function (Blueprint $table) {
            $table->enum('type', array_keys($this->labelsToCodes))->default('Suhu Ruangan')->change();
        });
    }
};
