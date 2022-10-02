<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('height_for_ages', function (Blueprint $table) {
            $table->id();
            $table->integer('age');
            $table->double('ss');
            $table->double('s_fr');
            $table->double('s_to');
            $table->double('n_fr');
            $table->double('n_to');
            $table->double('tall');
            $table->string('gender');
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
        Schema::dropIfExists('height_for_ages');
    }
};
