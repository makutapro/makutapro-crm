<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospect', function (Blueprint $table) {
            $table->id();
            $table->string('nama_prospect');
            $table->string('kode_negara')->default('+62');
            $table->string('hp');
            $table->string('email');
            $table->text('message')->nullable();
            $table->text('catatan')->nullable();
            $table->text('catatan_sales')->nullable();
            $table->tinyInteger('verified_status');
            $table->dateTime('verified_at')->nullable();
            $table->tinyInteger('accept_status')->nullable();
            $table->dateTime('accept_at')->nullable();
            $table->bigInteger('gender_id')->unsigned();
            $table->foreign('gender_id')->references('id')->on('gender')->onDelete('cascade');
            $table->bigInteger('status')->unsigned();
            $table->foreign('status')->references('id')->on('status')->onDelete('cascade');
            $table->bigInteger('usia_id')->unsigned()->nullable();
            $table->foreign('usia_id')->references('id')->on('usia')->onDelete('cascade');
            // $table->bigInteger('tempat_tinggal_id')->unsigned()->nullable();
            // $table->foreign('tempat_tinggal_id')->references('id')->on('city')->onDelete('cascade')->onUpdate();
            // $table->bigInteger('tempat_kerja_id')->unsigned()->nullable();
            // $table->foreign('tempat_kerja_id')->references('id')->on('city')->onDelete('cascade');
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');
            $table->bigInteger('pekerjaan_id')->unsigned()->nullable();
            $table->foreign('pekerjaan_id')->references('id')->on('pekerjaan')->onDelete('cascade');
            $table->bigInteger('penghasilan_id')->unsigned()->nullable();
            $table->foreign('penghasilan_id')->references('id')->on('penghasilan')->onDelete('cascade');
            $table->bigInteger('sumber_data_id')->unsigned()->nullable();
            $table->foreign('sumber_data_id')->references('id')->on('sumber_data')->onDelete('cascade');
            $table->string('note_sumber_data')->nullable();
            $table->bigInteger('sumber_platform_id')->unsigned()->nullable();
            $table->foreign('sumber_platform_id')->references('id')->on('sumber_platform')->onDelete('cascade');
            $table->bigInteger('sumber_ads_id')->unsigned()->nullable();
            $table->foreign('sumber_ads_id')->references('id')->on('sumber_ads')->onDelete('cascade');
            $table->bigInteger('campaign_id')->unsigned()->nullable();
            $table->foreign('campaign_id')->references('id')->on('campaign')->onDelete('cascade');
            $table->bigInteger('not_interested_id')->unsigned()->nullable();
            $table->foreign('not_interested_id')->references('id')->on('not_interested')->onDelete('cascade');
            $table->dateTime('not_interested_at')->nullable();
            $table->bigInteger('role_by')->unsigned()->nullable();//level input id
            $table->foreign('role_by')->references('id')->on('role')->onDelete('cascade');
            $table->string('input_by')->nullable();//input by username
            $table->string('edit_by')->nullable();//edit by username
            $table->bigInteger('tertarik_tipe_unit_id')->unsigned()->nullable();
            $table->foreign('tertarik_tipe_unit_id')->references('id')->on('unit')->onDelete('cascade');
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
        Schema::dropIfExists('prospect');
    }
}
