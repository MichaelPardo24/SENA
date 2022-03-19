<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('document', 20)->unique();
            $table->enum('document_type', ['C.C', 'T.I', 'C.E', 'Pasaporte']);
            $table->string('names', 45);
            $table->string('surnames', 45);
            $table->string('phone', 20)->nullable();
            $table->text('direction')->nullable();
            $table->date('birth_at')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
