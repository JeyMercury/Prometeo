<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('subject')->nullable();
            $table->string('adjunto')->nullable();
            $table->longText('body')->nullable();
            $table->boolean('enviado')->nullable();
            $table->integer('reintentos')->unsigned()->default(0);
            $table->string('ultimo_mensaje_error')->nullable();
            $table->integer('tipo')->unsigned()->nullable();
            $table->timestamp('fecha')->useCurrent();
            $table->integer('prioridad')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
