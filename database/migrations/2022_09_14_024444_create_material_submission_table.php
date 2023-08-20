<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_submission', function (Blueprint $table) {
            $table->id();
            $table->string('no_pp');
            $table->string('no_permohonan');
            $table->string('no_kontrak');
            $table->bigInteger('divisi_id')->unsigned();
            $table->bigInteger('vendor_id')->unsigned();
            $table->date('tgl_permohonan');
            $table->string('jenis_pemeriksaan');
            $table->string('jenis_pekerjaan');
            $table->string('keterangan')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_submission');
    }
};
