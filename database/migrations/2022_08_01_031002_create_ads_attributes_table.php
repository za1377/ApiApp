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
        Schema::create('ads_attributes', function (Blueprint $table) {
            $table->bigInteger('id' ,true , true);
            $table->unsignedBigInteger('ads_id');
            $table->unsignedBigInteger('attribute_id');
            $table->string('attribute_value');
            $table->timestamps();

            $table->foreign('ads_id')->references('id')->on('ads');
            $table->foreign('attribute_id')->references('id')->on('attributes');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads_attributes');
    }
};
