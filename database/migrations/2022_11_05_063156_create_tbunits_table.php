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
        Schema::create('tbunits', function (Blueprint $table) {
            $table->integer('unitId', 11);
            $table->string('unitPihakdetail', 8);
            $table->integer('unitIsiKS');
        });

        //relasi ke tabel tbpihak
        Schema::table('tbunits', function (Blueprint $table) {
            $table->foreign('unitPihakdetail')->references('pdId')->on('tbpihakdetails')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('unitIsiKS')->references('ksId')->on('tbkerjasamas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbunits');
    }
};
