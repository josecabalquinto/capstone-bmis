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
        Schema::create('weight_for_heights', function (Blueprint $table) {
            $table->id();
            $table->double('length');
            $table->double('sw');
            $table->double('w_fr');
            $table->double('w_to');
            $table->double('n_fr');
            $table->double('n_to');
            $table->double('ow_fr');
            $table->double('ow_to');
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
        Schema::dropIfExists('weight_for_heights');
    }
};
