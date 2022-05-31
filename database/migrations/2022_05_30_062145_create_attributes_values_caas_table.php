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
        Schema::create('attributes_values_caas', function (Blueprint $table) {
            $table->bigInteger('id' ,true , true);
            $table->unsignedBigInteger('caa_id');
            $table->unsignedBigInteger('attre_val_id');
            $table->timestamps();

            $table->foreign('caa_id')->references('id')->on('c_a_c_a');
            $table->foreign('attre_val_id')->references('id')->on('attributes_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes_values_caas');
    }
};
