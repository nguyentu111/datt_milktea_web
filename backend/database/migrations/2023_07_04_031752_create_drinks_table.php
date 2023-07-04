<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drinks', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('slug')->unique();
            $table->decimal('price',15,2,true);
            $table->mediumText('description');
            $table->string('picture');
            $table->unsignedBigInteger('tax_id');
            $table->foreign('tax_id')->references('id')->on('taxs');
            $table->tinyInteger('active');
            $table->unsignedBigInteger('tod_id')->nullable();
            $table->foreign('tod_id')->references('id')->on('type_of_drinks');
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
        Schema::dropIfExists('drinks');
    }
}
