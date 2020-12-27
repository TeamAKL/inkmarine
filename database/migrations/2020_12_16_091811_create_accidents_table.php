<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accidents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ship_name');
            $table->string('rank');
            $table->timestamp('date')->nullable();
            $table->string('type');
            $table->string('reason');
            $table->integer('cost');
            $table->string('currency');
            $table->string('re_use');
            $table->string('etc');
            $table->string('remark');
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
        Schema::dropIfExists('accidents');
    }
}
