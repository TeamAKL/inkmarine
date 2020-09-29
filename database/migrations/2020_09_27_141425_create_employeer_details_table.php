<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeer_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('basic_salary');
            $table->string('basicsalary_currency');
            $table->integer('home_allowance');
            $table->string('home_allowance_currency');
            $table->integer('total_salary');
            $table->string('total_salary_currency');
            $table->integer('fixed_pay');
            $table->string('fixpay_currency');
            $table->integer('leave_pay');
            $table->string('leavepay_currency');
            $table->integer('onbroad_pay');
            $table->string('onbroadpay_currency');
            $table->string('phone_number');
            $table->string('cell_phone_number');
            $table->string('drinking');
            $table->string('smoking');
            $table->timestamp('deperature_date');
            $table->string('rank');
            $table->string('company');
            $table->string('code');
            $table->integer('pants');
            $table->string('shoe');
            $table->bigInteger('employer_id');
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
        Schema::dropIfExists('employeer_details');
    }
}
