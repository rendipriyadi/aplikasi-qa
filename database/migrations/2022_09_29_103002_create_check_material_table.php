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
        Schema::create('check_material', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('inspection_material_id')->unsigned();
            $table->string('jenis');
            $table->string('sumber');
            $table->string('jumlah');
            $table->bigInteger('satuan_id');
            $table->string('metode');
            $table->string('hasil');
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
        Schema::dropIfExists('check_material');
    }
};
