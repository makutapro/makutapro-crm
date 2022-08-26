<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fu', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('prospect_id')->unsigned();
            $table->foreign('prospect_id')->references('id')->on('prospect')->onDelete('cascade');
            $table->bigInteger('agent_id')->unsigned();
            $table->foreign('agent_id')->references('id')->on('agent')->onDelete('cascade');
            $table->bigInteger('sales_id')->unsigned();
            $table->foreign('sales_id')->references('id')->on('sales')->onDelete('cascade');
            $table->bigInteger('media_fu_id')->unsigned();
            $table->foreign('media_fu_id')->references('id')->on('media_fu')->onDelete('cascade');
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
        Schema::dropIfExists('fu');
    }
}
