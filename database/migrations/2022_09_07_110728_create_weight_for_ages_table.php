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
        Schema::create('weight_for_ages', function (Blueprint $table) {
            $table->id();
            $table->integer('age');
            $table->double('su');
            $table->double('u_fr');
            $table->double('u_to');
            $table->double('n_fr');
            $table->double('n_to');
            $table->double('o');
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
        Schema::dropIfExists('weight_for_ages');
    }
};
