<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start_date')->nullable();
            
            // Info de la compañia / empresa
            $table->string('company_cod');
            $table->string('company_name');
            $table->string('company_address');

            // Info del jefe inmediato
            $table->string('boss_name');
            $table->string('boss_phone')->nullable();
            $table->string('boss_email', 50);

            // Info del sitio
            $table->string('town')->nullable();
            $table->string('dependency')->nullable();

            // Info del seguimiento
            $table->enum('status', [
                'Completo',
                'Incompleto',
            ])->default('Incompleto');

            // Visits
            $table->timestamp('first_visit_date')->nullable();
            $table->mediumText('first_observation')->nullable();

            $table->timestamp('second_visit_date')->nullable();
            $table->mediumText('second_observation')->nullable();

            // foreign keys
            $table->foreignId('ficha_id')->constrained('fichas');
            $table->foreignId('apprentice_id')->constrained('users');
            $table->foreignId('type_id')->constrained('production_stage_types');
            $table->foreignId('instructor_id')->nullable()->constrained('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follow_ups');
    }
}
