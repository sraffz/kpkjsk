<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJawatanDimohonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawatan_dimohon', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_permohonan');
            $table->string('nama_jawatan');
            $table->string('gred_jawatan');
            $table->string('bil_jawatan');
            $table->string('penempatan');
            $table->string('status_permohonan_jawatan');
            $table->string('catatan');
            $table->string('bil_diluluskan');
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
        Schema::dropIfExists('jawatan_dimohon');
    }
}
