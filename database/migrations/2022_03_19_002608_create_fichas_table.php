<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained();
            $table->unsignedBigInteger('code')->unique();
            $table->timestamp('start_school_stage');
            $table->timestamp('end_school_stage');
            $table->timestamp('start_production_stage');
            $table->timestamp('end_production_stage');
            $table->enum('type', [
                'Auxiliar',
                'Espc. Tecnologica',
                'Operario',
                'Profundizacion Tecnica',
                'Tecnologo',
                'Tecnico',
            ]);
            $table->string('town');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichas');
    }
}
