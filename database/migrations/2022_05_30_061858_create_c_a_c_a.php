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
        Schema::create('c_a_c_a', function (Blueprint $table) {
            $table->bigInteger('id' ,true , true);
            $table->unsignedBigInteger('cate_atrre_cate_id');
            $table->unsignedBigInteger('attributes_id');
            $table->timestamps();

            $table->foreign('cate_atrre_cate_id')->references('id')->on('categories__attributes_categories')->onDelete('cascade');
            $table->foreign('attributes_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories__attributes_categories__attributes');
    }
};
