<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('crew_code')->unique();
            $table->string('name');
            $table->string('nationality');
            $table->timestamp('date_of_birth');
            $table->string('place_of_birth');
            $table->string('education_level');
            $table->string('ship');
            $table->string('image');
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
        Schema::dropIfExists('employeers');
    }
}
