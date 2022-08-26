<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryBlastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_blast', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('prospect_id')->unsigned();
            $table->foreign('prospect_id')->references('id')->on('prospect')->onDelete('cascade');
            $table->bigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
            $table->bigInteger('agent_id')->unsigned();
            $table->foreign('agent_id')->references('id')->on('agent')->onDelete('cascade');
            $table->bigInteger('sales_id')->unsigned();
            $table->foreign('sales_id')->references('id')->on('sales')->onDelete('cascade');
            $table->bigInteger('blast_agent_id')->nullable();
            $table->bigInteger('blast_sales_id')->nullable();
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
        Schema::dropIfExists('history_blast');
    }
}
