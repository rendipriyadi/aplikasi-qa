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
        Schema::create('inspection_material', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('material_submission_id')->unsigned();
            $table->date('tgl_pemeriksaan');
            $table->string('lokasi');
            $table->string('file');
            $table->string('status')->nullable();
            $table->string('aprv_kasi')->nullable();
            $table->string('aprv_kadep')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('created_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('inspection_material');
    }
};
