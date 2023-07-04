<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('cheff_id');
            $table->foreign('cheff_id')->references('id')->on('staffs');
            $table->enum('status',['canceled','shipping','wait_for_shiping','success','processing','pending']);
            $table->timestamp('shipped_at')->nullable();
            $table->enum('payment_type',['cash','momo','zalo']);
            $table->string('bill_url');
            $table->decimal('ship_price',15,2);
            $table->decimal('total_price',15,2);
            $table->decimal('final_price',15,2);
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
        Schema::dropIfExists('orders');
    }
}
