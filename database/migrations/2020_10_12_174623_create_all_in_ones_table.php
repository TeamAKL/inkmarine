<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllInOnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_in_ones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employer_id');
            $table->bigInteger('coc');
            $table->bigInteger('gmbss');
            $table->longText('images');
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
        Schema::dropIfExists('all_in_ones');
    }
}
