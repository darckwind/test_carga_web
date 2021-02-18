<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoadTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('load_tests', function (Blueprint $table) {
            $table->bigIncrements('load_test_id');
            $table->string('load_test_name');
            $table->string('load_test_base_url');
            $table->string('load_test_post_url');
            $table->Integer('load_test_num_usr');
            $table->Integer('load_test_ramp_usr')->default(0);
            $table->boolean('load_test_rand_anws');
            $table->string('load_test_csv_token')->nullable();
            $table->string('load_test_file_charge')->nullable();
            $table->unsignedBigInteger('env_id');
            $table->foreign('env_id')->references('env_id')->on('environments');
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
        Schema::dropIfExists('load_tests');
    }
}
