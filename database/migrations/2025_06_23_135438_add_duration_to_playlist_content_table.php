<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('playlist_content', function (Blueprint $table) {
            $table->integer('duration') -> nullable();  // Tempo de exibição em segundos
        });
    }

    public function down()
    {
        Schema::table('playlist_content', function (Blueprint $table) {
            $table->dropColumn('duration');
        });
    }
};
