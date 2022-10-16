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
        Schema::create('ks_instansis', function (Blueprint $table) {
            $table->id('ksId');
            $table->string('ksJenis');
            $table->string('ksInstansi');
            $table->text('ksNama');
            $table->string('ksKota', 50);
            $table->string('ksNegara', 50);
            $table->string('ksNoKS', 50);
            $table->date('ksTglKontrak');
            $table->date('ksTglAkhir');
            $table->string('ksJangka', 50);
            $table->text('ksIsiKS');
            $table->string('ksKet');
            $table->string('ksFile', 100);
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
        Schema::dropIfExists('ks_instansis');
    }
};
