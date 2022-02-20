<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelTestValuesTable extends Migration
{
    public function up()
    {
        Schema::create('level_test_values', function (Blueprint $table) {
            $table->primary(['level_transput_id', 'level_test_id']);

            $table->boolean('value');
            $table->foreignId('level_transput_id');
            $table->foreignId('level_test_id');

            $table->foreign('level_transput_id')->on('level_transputs')->references('id')
                ->onDelete('cascade');
            $table->foreign('level_test_id')->on('level_tests')->references('id')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('level_test_values');
    }
}
