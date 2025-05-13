<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScheduleFieldsToContentsAndPlaylistsTables extends Migration
{
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->timestamp('start_at')->nullable()->after('updated_at');
            $table->timestamp('end_at')->nullable()->after('start_at');
        });

        Schema::table('playlists', function (Blueprint $table) {
            $table->timestamp('start_at')->nullable()->after('updated_at');
            $table->timestamp('end_at')->nullable()->after('start_at');
        });
    }

    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn(['start_at', 'end_at']);
        });

        Schema::table('playlists', function (Blueprint $table) {
            $table->dropColumn(['start_at', 'end_at']);
        });
    }
}
