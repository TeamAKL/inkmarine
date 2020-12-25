<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalCheckupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_checkups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employer_id');
            $table->timestamp('med_date');
            $table->string('height');
            $table->string('weight');
            $table->string('checst');
            $table->string('tooth');
            $table->string('tooth_state');
            $table->string('color_blindness');
            $table->string('blood_type');
            $table->string('xray');
            $table->string('sight_left');
            $table->string('sight_right');
            $table->string('hearing_left');
            $table->string('hearing_right');
            $table->string('hospital');
            $table->string('decision');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_checkups');
    }
}
