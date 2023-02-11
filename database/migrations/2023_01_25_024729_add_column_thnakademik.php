<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnThnakademik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tahunakademiks', function (Blueprint $table) {
            $table->date('tgl_batas_uts')->nullable();
            $table->date('tgl_batas_uas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tahunakademiks', function (Blueprint $table) {
            $table->dropColumn('tgl_batas_uts');
            $table->dropColumn('tgl_batas_uas');
        });
    }
}
