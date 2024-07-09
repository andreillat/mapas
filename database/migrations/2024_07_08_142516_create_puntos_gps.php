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
        
        Schema::create('puntos_gps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dispositivo');
            $table->string('imei');
            $table->dateTime('tiempo');
            $table->string('placa');
            $table->string('version');
            $table->decimal('longitud', 10, 7);
            $table->decimal('latitud', 10, 7);
            $table->dateTime('fecha_recepcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puntos_gps');
    }
};
