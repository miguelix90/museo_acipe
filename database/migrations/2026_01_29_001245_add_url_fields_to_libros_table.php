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
        Schema::table('libros', function (Blueprint $table) {
            $table->string('url_imagen_portada')->nullable()->after('fecha_edicion');
            $table->string('url_resena')->nullable()->after('url_imagen_portada');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('libros', function (Blueprint $table) {
            $table->dropColumn(['url_imagen_portada', 'url_resena']);
        });
    }
};
