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
        Schema::create('attributes_types_caas', function (Blueprint $table) {
            $table->bigInteger('id' ,true , true);
            $table->unsignedBigInteger('caa_id');
            $table->unsignedBigInteger('attre_type_id');
            $table->timestamps();

            $table->foreign('caa_id')->references('id')->on('c_a_c_a')->onDelete('cascade');
            $table->foreign('attre_type_id')->references('id')->on('attributes_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes_types_caas');
    }
};
