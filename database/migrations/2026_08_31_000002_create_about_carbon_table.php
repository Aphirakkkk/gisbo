<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAboutCarbonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('about_carbon')) {
            Schema::create('about_carbon', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('image1')->nullable();
                $table->text('image2')->nullable();
                $table->bigInteger('active_status')->default(1);
                $table->bigInteger('display_status')->default(1);
                $table->integer('sort_number')->default(1)->nullable();
                $table->bigInteger('created_by')->default(1)->nullable();
                $table->bigInteger('updated_by')->default(1)->nullable();
                $table->string('ip_address')->nullable();
                $table->timestamps();
            });

            // Insert initial default data
            DB::table('about_carbon')->insert([
                'image1' => 'assets/frontend/img/carbon1.png',
                'image2' => 'assets/frontend/img/carbon2.png',
                'active_status' => 1,
                'display_status' => 1,
                'sort_number' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'ip_address' => '127.0.0.1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about_carbon');
    }
}
