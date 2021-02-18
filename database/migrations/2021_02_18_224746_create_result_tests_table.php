<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_tests', function (Blueprint $table) {
            $table->bigIncrements('result_test_id');
            $table->string('result_test_path');
            $table->unsignedBigInteger('load_test_id');
            $table->foreign('load_test_id')->references('load_test_id')->on('load_tests');
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
        Schema::dropIfExists('result_tests');
    }
}
