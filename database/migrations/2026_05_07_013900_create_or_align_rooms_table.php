<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('rooms')) {
            Schema::create('rooms', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('type');
                $table->text('descriptions')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });

            return;
        }

        Schema::table('rooms', function (Blueprint $table) {
            if (Schema::hasColumn('rooms', 'description') && ! Schema::hasColumn('rooms', 'descriptions')) {
                $table->renameColumn('description', 'descriptions');
            }
        });

        Schema::table('rooms', function (Blueprint $table) {
            if (Schema::hasColumn('rooms', 'type')) {
                $table->string('type')->change();
            }

            if (Schema::hasColumn('rooms', 'descriptions')) {
                $table->text('descriptions')->nullable()->change();
            }

            if (! Schema::hasColumn('rooms', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('descriptions');
            }

            if (! Schema::hasColumn('rooms', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }

            if (! Schema::hasColumn('rooms', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });

        if (Schema::hasColumn('rooms', 'created_at')) {
            DB::table('rooms')
                ->where('created_at', '0000-00-00 00:00:00')
                ->update(['created_at' => now()]);

            DB::table('rooms')
                ->whereNull('created_at')
                ->update(['created_at' => now()]);
        }

        if (Schema::hasColumn('rooms', 'updated_at')) {
            DB::table('rooms')
                ->where('updated_at', '0000-00-00 00:00:00')
                ->update(['updated_at' => now()]);

            DB::table('rooms')
                ->whereNull('updated_at')
                ->update(['updated_at' => now()]);
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('rooms')) {
            return;
        }

        Schema::table('rooms', function (Blueprint $table) {
            if (Schema::hasColumn('rooms', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};
