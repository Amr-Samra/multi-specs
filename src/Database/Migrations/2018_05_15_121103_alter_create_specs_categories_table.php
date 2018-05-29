<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCreateSpecsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('specs_categories', function (Blueprint $table) {
            $table->dropForeign(['specs_id']);
            $table->renameColumn('specs_id', 'spec_id');
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
        Schema::dropIfExists('specs_categories');
        Schema::disableForeignKeyConstraints();
    }
}
