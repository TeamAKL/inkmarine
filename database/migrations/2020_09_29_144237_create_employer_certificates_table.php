<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployerCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_certificates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('certificate_id');
            $table->bigInteger('employer_id');
            $table->string('licine_number');
            $table->timestamp('training_date');
            $table->timestamp('expire_date')->useCurrent();
            $table->longText('image');
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
        Schema::dropIfExists('employer_certificates');
    }
}
