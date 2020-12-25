<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInjuriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('injuries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('illness');
            $table->string('medical_name');
            $table->string('hospital_name');
            $table->string('start_date');
            $table->string('recovery_date');
            $table->string('hospital_type');
            $table->string('expenses_won');
            $table->string('expenses_won_currency')->nullable();
            $table->string('expenses_ex');
            $table->string('expenses_ex_currency')->nullable();
            $table->string('remark');
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
        Schema::dropIfExists('injuries');
    }
}
