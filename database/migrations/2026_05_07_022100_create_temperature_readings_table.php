<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $deviceIdType = $this->deviceIdType();

        if (Schema::hasTable('temperature_readings')) {
            Schema::table('temperature_readings', function (Blueprint $table) use ($deviceIdType) {
                if ($deviceIdType === 'int') {
                    $table->integer('device_id')->change();
                } else {
                    $table->unsignedBigInteger('device_id')->change();
                }

                $table->foreign('device_id')->references('id')->on('devices')->restrictOnDelete();
            });

            return;
        }

        Schema::create('temperature_readings', function (Blueprint $table) {
            $table->id();
            if ($this->deviceIdType() === 'int') {
                $table->integer('device_id');
            } else {
                $table->unsignedBigInteger('device_id');
            }
            $table->decimal('temperature', 5, 2);
            $table->timestamp('recorded_at')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->foreign('device_id')->references('id')->on('devices')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('temperature_readings');
    }

    private function deviceIdType(): string
    {
        if (DB::connection()->getDriverName() !== 'mysql') {
            return 'bigint';
        }

        $column = DB::selectOne(
            'select data_type from information_schema.columns where table_schema = database() and table_name = ? and column_name = ?',
            ['devices', 'id']
        );

        return $column?->DATA_TYPE === 'int' ? 'int' : 'bigint';
    }
};
