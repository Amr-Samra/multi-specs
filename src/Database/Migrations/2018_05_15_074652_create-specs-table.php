<?php

// use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Database\Migrations\Migration;

// class CreateSpecsTable extends Migration
// {
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         Schema::create('specs', function (Blueprint $table) {
//             $table->increments('id');
//             $table->string('name');
//             $table->string('type');
//             $table->string('key')->unique();
//             $table->boolean('is_required')->default(0);
//             $table->string('default')->nullable();
//             $table->string('options')->nullable();
//             $table->integer('order')->default(1);
//             $table->boolean('is_active')->default(1);
//             $table->string('details')->nullable();
//             $table->timestamps();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         Schema::dropIfExists('specs');
//     }
// }
