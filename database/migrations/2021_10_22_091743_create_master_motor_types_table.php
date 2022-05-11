<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterMotorTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_motor_types', function (Blueprint $table) {
            $table->id();
            $table->string('fldsno');
            $table->string('fldmtype',100);
            $table->double('fldvoltage');
            $table->double('flddradius');
            $table->double('fldbthickness');
            $table->double('fldpower');
            $table->double('fldspeed');
            $table->double('fldarmlength');
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
        Schema::dropIfExists('master_motor_types');
    }
}
