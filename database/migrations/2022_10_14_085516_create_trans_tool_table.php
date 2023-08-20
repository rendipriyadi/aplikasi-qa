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
        Schema::create('trans_tool', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transfer_material_id')->unsigned();
            $table->string('jenis')->nullable();
            $table->string('type')->nullable();
            $table->string('kapasitas')->nullable();
            $table->string('tahun')->nullable();
            $table->string('jumlah')->nullable();
            $table->bigInteger('satuan_id')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('hasil')->nullable();
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
        Schema::dropIfExists('trans_tool');
    }
};
