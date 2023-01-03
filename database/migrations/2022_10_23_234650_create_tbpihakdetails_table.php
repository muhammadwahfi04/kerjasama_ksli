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
        if(Schema::hasTable('tbpihakdetails')) return;
        Schema::create('tbpihakdetails', function (Blueprint $table) {
            $table->string('pdId', 8)->primary();
            $table->string('pdKode', 2);
            $table->string('pdNama', 30);
        });

        //relasi ke tabel tbpihak
        Schema::table('tbpihakdetails', function (Blueprint $table) {
            $table->foreign('pdKode')->references('pihakId')->on('tbpihaks')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbpihakdetails');
    }
};
