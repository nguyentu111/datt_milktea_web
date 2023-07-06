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
            $table->unsignedBigInteger('cheff_id')->nullable();
            $table->foreign('cheff_id')->references('id')->on('staffs');
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->enum('status',['canceled','shipping','wait_for_shiping','success','processing','pending']);
            $table->timestamp('shipped_at')->nullable();
            $table->string('ship_to')->nullable();
            $table->decimal('ship_amount',15,2)->nullable();
            $table->decimal('tax_amount',15,2);
            $table->decimal('total_amount',15,2);
            $table->enum('payment_type',['cash','momo','zalopay']);
            $table->tinyInteger('is_paid');
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
