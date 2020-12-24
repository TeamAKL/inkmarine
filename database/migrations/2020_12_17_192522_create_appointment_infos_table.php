<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('division');
            $table->string('ship_name');
            $table->string('rank');
            $table->string('boarding_date');
            $table->string('leaving_date');
            $table->string('boarding_period');
            $table->string('place');
            $table->text('remark');
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('appointment_infos');
    }
}
