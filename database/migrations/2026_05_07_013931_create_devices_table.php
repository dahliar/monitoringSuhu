<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('devices')) {
            Schema::table('devices', function (Blueprint $table) {
                if (! Schema::hasColumn('devices', 'is_active')) {
                    $table->boolean('is_active')->default(true)->after('minTemperature');
                }
            });

            return;
        }

        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jenis');
            $table->unsignedBigInteger('idRoom');
            $table->string('lokasi');
            $table->decimal('maxTemperature', 5, 2);
            $table->decimal('minTemperature', 5, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('idRoom')->references('id')->on('rooms')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('devices') && Schema::hasColumn('devices', 'is_active')) {
            Schema::table('devices', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });

            return;
        }

        Schema::dropIfExists('devices');
    }
};
