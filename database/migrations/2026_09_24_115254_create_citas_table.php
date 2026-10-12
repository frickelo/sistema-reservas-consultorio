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
    Schema::create('citas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')
              ->constrained('users')
              ->onDelete('cascade');   // si se borra el usuario, se borran sus citas

        $table->foreignId('medico_id')
              ->constrained('medicos')
              ->onDelete('cascade');   // si se borra el médico, se borran sus citas

        $table->date('fecha');
        $table->time('hora');
        $table->text('motivo')->nullable();

        $table->enum('estado', ['pendiente', 'confirmada', 'cancelada', 'completada'])
              ->default('pendiente');

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
