<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('devices')) {
            return;
        }

        DB::table('devices')
            ->where('created_at', '0000-00-00 00:00:00')
            ->update(['created_at' => now()]);

        DB::table('devices')
            ->where('updated_at', '0000-00-00 00:00:00')
            ->update(['updated_at' => now()]);

        Schema::table('devices', function (Blueprint $table) {
            if (Schema::hasColumn('devices', 'jenis')) {
                $table->string('jenis')->change();
            }

            if (Schema::hasColumn('devices', 'lokasi')) {
                $table->string('lokasi')->change();
            }

            if (Schema::hasColumn('devices', 'maxTemperature')) {
                $table->decimal('maxTemperature', 5, 2)->change();
            }

            if (Schema::hasColumn('devices', 'minTemperature')) {
                $table->decimal('minTemperature', 5, 2)->change();
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('devices')) {
            return;
        }

        Schema::table('devices', function (Blueprint $table) {
            if (Schema::hasColumn('devices', 'maxTemperature')) {
                $table->float('maxTemperature')->change();
            }

            if (Schema::hasColumn('devices', 'minTemperature')) {
                $table->float('minTemperature')->change();
            }
        });
    }
};
