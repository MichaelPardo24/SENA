<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ficha_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->enum('status', [
                'Certificado',
                'Finalizado',
                'Pendiente',
                'Preparado',
            ]);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ficha_user');
    }
}
