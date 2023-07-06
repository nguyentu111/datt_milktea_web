<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->unsignedBigInteger('drink_size_id');
            $table->foreign('drink_size_id')->references('id')->on('drink_sizes');
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('products');
            $table->decimal('amount',10,4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
