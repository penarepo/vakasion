<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnVakasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_vakasis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_jadwal');
            // $table->integer('insentif_vakasi');
            // $table->integer('insentif_soal');
            // $table->string('status_cetak');
            $table->integer('insentif_vakasi_uts')->nullable();
            $table->integer('insentif_soal_uts')->nullable();
            $table->string('status_cetak_uts')->nullable();
            $table->integer('insentif_vakasi_uas')->nullable();
            $table->integer('insentif_soal_uas')->nullable();
            $table->string('status_cetak_uas')->nullable();
            // $table->string('jenis_vakasi');
            $table->date('tgl_cetak_uts')->nullable();
            $table->date('tgl_cetak_uas')->nullable();
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
        Schema::dropIfExists('trn_vakasis');
    }
}
