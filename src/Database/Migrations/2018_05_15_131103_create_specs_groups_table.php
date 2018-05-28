<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecsGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specs_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->integer('spec_id')->unsigned();
            $table->string('value');
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('specs_items')->onDelete('cascade');
            $table->foreign('spec_id')->references('id')->on('specs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::enableForeignKeyConstraints();
        Schema::dropIfExists('specs_groups');
        Schema::disableForeignKeyConstraints();
    }
}
