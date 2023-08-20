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
        Schema::create('file_material_submission', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('material_submission_id')->unsigned();
            $table->string('kak');
            $table->string('pcm');
            $table->string('brosur');
            $table->string('file_lain')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('file_material_submission');
    }
};