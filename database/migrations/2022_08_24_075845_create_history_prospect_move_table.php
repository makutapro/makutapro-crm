<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryProspectMoveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_prospect_move', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('prospect_id')->unsigned();
            $table->foreign('prospect_id')->references('id')->on('prospect')->onDelete('cascade');
            $table->bigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
            $table->bigInteger('agent_id')->unsigned();
            $table->foreign('agent_id')->references('id')->on('agent')->onDelete('cascade');
            $table->bigInteger('move_agent_id')->nullable()->default(12);
            $table->bigInteger('agent_id_prev')->unsigned();
            $table->foreign('agent_id_prev')->references('id')->on('agent')->onDelete('cascade');
            $table->bigInteger('move_agent_id_prev')->nullable()->default(12);
            $table->bigInteger('sales_id')->unsigned();
            $table->foreign('sales_id')->references('id')->on('sales')->onDelete('cascade');
            $table->bigInteger('move_sales_id')->nullable()->default(12);
            $table->bigInteger('sales_id_prev')->unsigned();
            $table->foreign('sales_id_prev')->references('id')->on('sales')->onDelete('cascade');
            $table->bigInteger('move_sales_id_prev')->nullable()->default(12);
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
        Schema::dropIfExists('history_prospect_move');
    }
}
