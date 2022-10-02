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
        Schema::create('growth_tracks', function (Blueprint $table) {
            $table->id();
            $table->integer('child_id');
            $table->integer('age');
            $table->double('weight');
            $table->double('height');
            $table->string('wfa')->nullable();
            $table->string('hfa')->nullable();
            $table->string('wfh')->nullable();
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
        Schema::dropIfExists('growth_tracks');
    }
};
