<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsiGraphScalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isi_graph_scales', function (Blueprint $table) {
            $table->id();
            $table->string('fldpno');
            $table->string('fldsno');
            $table->double('xaxis');
            $table->double('yaxis1');
            $table->double('yaxis2');
            $table->double('yaxis3');
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
        Schema::dropIfExists('isi_graph_scales');
    }
}
