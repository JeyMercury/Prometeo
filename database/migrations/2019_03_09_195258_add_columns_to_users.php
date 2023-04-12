<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('imagen_id')->nullable()->after('activo');
            $table->unsignedBigInteger('fichero_id')->nullable()->after('activo');

            $table->foreign('imagen_id')->references('id')->on('files');
            $table->foreign('fichero_id')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_fichero_id_foreign');
            $table->dropForeign('users_imagen_id_foreign');
        });
    }
};
