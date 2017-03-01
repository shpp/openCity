<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeParameterTitles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameter_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->string('icon')->nullable()->default(null);
            $table->timestamps();
        });
    
        DB::table('parameter_types')->insert([
            ['name' => 'person', 'icon' => '/img/icons/head.png'],
            ['name' => 'phone', 'icon' => '/img/icons/phone.png'],
            ['name' => 'email', 'icon' => '/img/icons/email.png'],
            ['name' => 'web', 'icon' => '/img/icons/website.png'],
            ['name' => 'text', 'icon' => '/img/icons/text.png'],
        ]);

        Schema::table('parameter_titles', function (Blueprint $table) {
            $table->integer('parameter_type_id')
                    ->unsigned()
                    ->nullable()
                    ->default(null);
            $table->foreign('parameter_type_id')
                    ->references('id')->on('parameter_types')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameter_types');
        Schema::table('parameter_titles', function (Blueprint $table) {
            $table->dropColumn('parameter_type_id');
        });
    }
}
