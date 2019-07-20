
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaketTable extends Migration
{
    /**
     * Run the migrations.
     * @table Paket
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Paket', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ket_paket', 255)->nullable();
            $table->date('wkt_terima')->nullable();
            $table->date('wkt_serah')->nullable();
            $table->integer('idUser_petugas_terima')->unsigned()->nullable();
            $table->integer('idUser_pegawai_terima')->unsigned()->nullable();
            $table->integer('idUser_petugas_serah')->unsigned()->nullable();
            $table->integer('idUser_pegawai_serah')->unsigned()->nullable();
            # Indexes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {

        Schema::drop('Paket');
    }
}
