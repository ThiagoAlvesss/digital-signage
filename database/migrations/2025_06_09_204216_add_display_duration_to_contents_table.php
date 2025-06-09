<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDisplayDurationToContentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->integer('display_duration')->default(7)->after('end_at')->comment('Duração em segundos para exibição do conteúdo no player');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn('display_duration');
        });
    }
}
