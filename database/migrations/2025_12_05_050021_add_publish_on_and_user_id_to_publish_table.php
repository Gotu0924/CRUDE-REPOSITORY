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
        Schema::table('publish', function (Blueprint $table) {
            // Add published_on column
            if (!Schema::hasColumn('publish', 'published_on')) {
                $table->date('published_on')->nullable()->after('author');
            }

            // Add task_id column
            if (!Schema::hasColumn('publish', 'task_id')) {
                $table->unsignedBigInteger('task_id')->nullable()->after('published_on');
            }

            // Add user_id column
            if (!Schema::hasColumn('publish', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('task_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publish', function (Blueprint $table) {
            if (Schema::hasColumn('publish', 'published_on')) {
                $table->dropColumn('published_on');
            }

            if (Schema::hasColumn('publish', 'task_id')) {
                $table->dropColumn('task_id');
            }

            if (Schema::hasColumn('publish', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
};
