<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaggingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pagging', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->string('route_name', 255)->nullable();
			$table->integer('numofpage')->default(1);
			$table->tinyInteger('language_id')->default(2);
			$table->integer('priority')->default(1);
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
        Schema::dropIfExists('tbl_pagging');
    }
}
