<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeKeysInTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imgs', function (Blueprint $table) {
            $table->foreign('place_id')
                  ->references('id')->on('places')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });

        Schema::table('places', function (Blueprint $table) {
            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onUpdate('cascade')
                  ->onDelete('set null');            
        });

        Schema::table('accessibilities', function (Blueprint $table) {
            $table->foreign('place_id')
                  ->references('id')->on('places')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreign('acces_title_id')
                  ->references('id')->on('accessibility_titles')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');                  
        });

        
        Schema::table('parameters', function (Blueprint $table) {
            $table->foreign('place_id')
                  ->references('id')->on('places')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreign('param_title_id')
                  ->references('id')->on('parameter_titles')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');   
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
