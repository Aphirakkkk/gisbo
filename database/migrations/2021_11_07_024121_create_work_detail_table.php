<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('tilte_job_th');
            $table->text('tilte_job_en');
            $table->text('job_description_th');
            $table->text('job_description_en');
            $table->text('position');
            $table->bigInteger('active_status')->length(20);
            $table->bigInteger('display_status')->length(20);
            $table->integer('sort_number')->nullable()->length(11);
            $table->bigInteger('created_by')->length(20);
            $table->bigInteger('updated_by')->length(20)->nullable();
            $table->string('ip_address'); //IP
            $table->timestamps(); //วันเวลาที่ทำและแก้ไข ระบบสร้างอัตโนมัติ
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_detail');
    }
}
