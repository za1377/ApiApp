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
        Schema::create('categories__attributes_categories', function (Blueprint $table) {
            $table->bigInteger('id' ,true , true);
            $table->unsignedBigInteger('attribute_category_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('attribute_category_id')->references('id')->on('attribute_categories');
            $table->foreign('category_id')->references('id')->on('categories');

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
        Schema::dropIfExists('categories__attributes_categories');
    }
};
