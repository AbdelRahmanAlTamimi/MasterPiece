<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('discussions', function (Blueprint $table) {

            $table->dropForeign(['topic_id']);


            $table->foreign('topic_id')
                ->references('id')
                ->on('topics')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('discussions', function (Blueprint $table) {
            $table->dropForeign(['topic_id']);


            $table->foreign('topic_id')
                ->references('id')
                ->on('topics');
        });
    }
};
