<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_log', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('prospect_id')->unsigned();
            $table->foreign('prospect_id')->references('id')->on('prospect')->onDelete('cascade');
            $table->bigInteger('status')->unsigned();
            $table->foreign('status')->references('id')->on('status')->onDelete('cascade');
            $table->bigInteger('sales_id')->unsigned();
            $table->foreign('sales_id')->references('id')->on('sales')->onDelete('cascade');
            $table->longText('notes')->nullable();
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
        Schema::dropIfExists('status_log');
    }
}
