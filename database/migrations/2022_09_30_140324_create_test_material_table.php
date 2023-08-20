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
        Schema::create('test_material', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('check_material_id')->unsigned();
            $table->bigInteger('material_testing_id')->unsigned();
            $table->string('metode');
            $table->string('jumlah');
            $table->string('satuan_id');
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
        Schema::dropIfExists('test_material');
    }
};
