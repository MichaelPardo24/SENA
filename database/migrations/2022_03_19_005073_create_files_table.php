<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('files', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('url');
        //     $table->enum('status', [
        //         'activo',
        //         'inactivo',
        //     ]);
        //     $table->foreignId('type_id')->constrained('file_types');
        //     $table->foreignId('followup_id')->constrained('follow_ups');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
