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
            $table->timestamp('date');
            $table->timestamp('start_ps_date');
            $table->timestamp('end_ps_date')->nullable();
            
            // Company
            $table->unsignedBigInteger('cod_company');
            $table->string('name_company');
            $table->string('address_company');

            // Boss
            $table->string('name_boss');
            $table->string('email_boss')->nullable();
            $table->string('phone_boss', 50);

            $table->string('town')->nullable();
            $table->string('dependency')->nullable();
            $table->enum('status', [
                'Completo',
                'Incompleto',
            ])->default('Incompleto');

            // Visits
            $table->timestamp('first_visit')->nullable();
            $table->mediumText('first_observation')->nullable();
            $table->timestamp('second_visit')->nullable();
            $table->mediumText('second_observation')->nullable();

            // foreign keys
            $table->foreignId('type_id')->constrained('production_stage_types');
            $table->foreignId('apprentice_id')->constrained('users');
            $table->foreignId('instructor_id')->constrained('users');
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
