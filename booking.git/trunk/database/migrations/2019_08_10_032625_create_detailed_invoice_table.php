<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailedInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailed_invoice', function (Blueprint $table) {
            $table->bigInteger('bill_id')->unsigned();
            $table->foreign('bill_id')
                ->references('bill_id')
                ->on('bill')
                ->onDelete('cascade');
            $table->bigInteger('room_id')->unsigned();
            $table->foreign('room_id')
                ->references('id')
                ->on('room')
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
        Schema::dropIfExists('detailed_invoice');
    }
}
