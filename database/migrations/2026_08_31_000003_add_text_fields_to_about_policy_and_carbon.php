<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTextFieldsToAboutPolicyAndCarbon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('about_policy')) {
            Schema::table('about_policy', function (Blueprint $table) {
                if (!Schema::hasColumn('about_policy', 'tilte_th')) {
                    $table->text('tilte_th')->nullable()->after('id');
                }
                if (!Schema::hasColumn('about_policy', 'tilte_en')) {
                    $table->text('tilte_en')->nullable()->after('tilte_th');
                }
                if (!Schema::hasColumn('about_policy', 'detail_th')) {
                    $table->longText('detail_th')->nullable()->after('tilte_en');
                }
                if (!Schema::hasColumn('about_policy', 'detail_en')) {
                    $table->longText('detail_en')->nullable()->after('detail_th');
                }
            });
        }

        if (Schema::hasTable('about_carbon')) {
            Schema::table('about_carbon', function (Blueprint $table) {
                if (!Schema::hasColumn('about_carbon', 'tilte_th')) {
                    $table->text('tilte_th')->nullable()->after('id');
                }
                if (!Schema::hasColumn('about_carbon', 'tilte_en')) {
                    $table->text('tilte_en')->nullable()->after('tilte_th');
                }
                if (!Schema::hasColumn('about_carbon', 'detail_th')) {
                    $table->longText('detail_th')->nullable()->after('tilte_en');
                }
                if (!Schema::hasColumn('about_carbon', 'detail_en')) {
                    $table->longText('detail_en')->nullable()->after('detail_th');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('about_policy')) {
            Schema::table('about_policy', function (Blueprint $table) {
                $table->dropColumn(['tilte_th', 'tilte_en', 'detail_th', 'detail_en']);
            });
        }

        if (Schema::hasTable('about_carbon')) {
            Schema::table('about_carbon', function (Blueprint $table) {
                $table->dropColumn(['tilte_th', 'tilte_en', 'detail_th', 'detail_en']);
            });
        }
    }
}
