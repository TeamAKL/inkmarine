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
            $table->integer('basic_salary')->nullable();
            $table->string('basicsalary_currency')->nullable();
            $table->integer('home_allowance')->nullable();
            $table->string('home_allowance_currency')->nullable();
            $table->integer('total_salary')->nullable();
            $table->string('total_salary_currency')->nullable();
            $table->integer('fixed_pay')->nullable();
            $table->string('fixpay_currency')->nullable();
            $table->integer('leave_pay')->nullable();
            $table->string('leavepay_currency')->nullable();
            $table->integer('onbroad_pay')->nullable();
            $table->string('onbroadpay_currency')->nullable();
            $table->string('phone_number');
            $table->string('cell_phone_number');
            $table->string('drinking')->nullable();
            $table->string('smoking')->nullable();
            $table->timestamp('deperature_date');
            $table->string('rank');
            $table->string('company');
            $table->string('code')->nullable();
            $table->integer('pants')->nullable();
            $table->string('shoe')->nullable();
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
