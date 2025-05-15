<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome do player ou TV
            $table->string('location')->nullable(); // Localização do player
            $table->foreignId('playlist_id')->nullable()->constrained('playlists')->onDelete('set null'); // Playlist atribuída
            $table->string('identifier')->unique(); // Identificador único para o player
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('players');
    }
}
