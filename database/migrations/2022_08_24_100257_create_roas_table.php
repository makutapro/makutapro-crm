<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
            $table->bigInteger('google')->nullable();
            $table->bigInteger('sosmed')->nullable();
            $table->bigInteger('detik')->nullable();
            $table->bigInteger('bud_google')->nullable();
            $table->bigInteger('bud_sosmed')->nullable();
            $table->bigInteger('bud_detik')->nullable();
            $table->bigInteger('budget')->nullable();
            $table->bigInteger('bulan')->nullable();
            $table->bigInteger('tahun')->nullable();
            $table->bigInteger('received_budget')->nullable();
            $table->bigInteger('received_date')->nullable();
            $table->bigInteger('cpl')->nullable();
            $table->bigInteger('cpa')->nullable();
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
        Schema::dropIfExists('roas');
    }
}
