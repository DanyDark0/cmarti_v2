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
        Schema::table('actividades', function (Blueprint $table) {
            $table->string('slug')->unique()->after('titulo');
        });
        
        Schema::table('convocatorias', function (Blueprint $table) {
            $table->string('slug')->unique()->after('titulo');
        });
    
            
        Schema::table('documentos', function (Blueprint $table) {
            $table->string('slug')->unique()->after('titulo');
        });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('convocatorias', function (Blueprint $table) {
            //
        });
    }
};
