<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTerkiniPermohonansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_terkini_permohonan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_jawatan_dipohon');
            $table->string('status_jawatan');
            $table->string('tarikh');
            $table->string('catatan');
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
        Schema::dropIfExists('status_terkini_permohonan');
    }
}
