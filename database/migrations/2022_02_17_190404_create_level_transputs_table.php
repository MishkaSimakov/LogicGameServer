<?php

use App\Models\Level;
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
        Schema::create('level_transputs', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->enum('type', [Level::INPUT, Level::OUTPUT]);
            $table->foreignId('level_id');

            $table->timestamps();

            $table->foreign('level_id')->on('levels')->references('id')
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
        Schema::dropIfExists('level_transputs');
    }
};
