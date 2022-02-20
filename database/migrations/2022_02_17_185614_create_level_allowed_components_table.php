<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_allowed_components', function (Blueprint $table) {
            $table->index(['level_id', 'logical_component_id']);

            $table->foreignId('level_id');
            $table->foreignId('logical_component_id');

            $table->foreign('level_id')->on('levels')->references('id')
                ->onDelete('cascade');
            $table->foreign('logical_component_id')->on('logical_components')->references('id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('level_allowed_components');
    }
};
