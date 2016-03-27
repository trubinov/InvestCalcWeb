<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_transactions', function (Blueprint $table) {
            // we dont need an id column yet
            // $table->increments('id');
            $table->timestamps();
            $table->integer('stock_id', false, true);  // link with stock_codes
            $table->integer('s_count');
            $table->double('price');
            $table->dateTime('trans_date');
            $table->foreign('stock_id')
                ->references('id')
                ->on('stock_codes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stock_transactions');
    }
}
