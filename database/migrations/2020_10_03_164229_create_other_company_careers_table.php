<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherCompanyCareersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_company_careers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('rank');
            $table->integer('grt');
            $table->integer('kw');
            $table->string('company_name');
            $table->string('ship_name');
            $table->timestamp('boarding_date');
            $table->timestamp('leaving_date')->useCurrent();
            $table->string('area');
            $table->text('remark');
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
        Schema::dropIfExists('other_company_careers');
    }
}
