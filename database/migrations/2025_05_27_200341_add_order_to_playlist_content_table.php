<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderToPlaylistContentTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('playlist_content', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('content_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('playlist_content', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}