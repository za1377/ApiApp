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
            $table->unsignedBigInteger('attre_cate_id');
            $table->unsignedBigInteger('cate_id');
            $table->timestamps();

            $table->foreign('attre_cate_id')->references('id')->on('attribute_categories');
            $table->foreign('cate_id')->references('id')->on('categories');

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
