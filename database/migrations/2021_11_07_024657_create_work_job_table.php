<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_job', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('first_name');
            $table->text('last_name');
            $table->text('email');
            $table->text('telephone');
            $table->text('Job_Position');
            $table->text('details');
            $table->text('images');
            $table->text('file');
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
        Schema::dropIfExists('work_job');
    }
}
