<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticpageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_staticpage', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->string('map', 255)->nullable();
			$table->string('pagecode', 255);
			$table->text('brief')->nullable();
			$table->text('content')->nullable();
			$table->string('image', 255)->nullable();
			$table->string('htmlfile', 255)->nullable();
			$table->text('keyword')->nullable();
			$table->text('meta_description')->nullable();
			$table->tinyInteger('language_id')->default(2);
			$table->integer('priority')->default(1);
			$table->tinyInteger('isdefault')->default(0);
			$table->tinyInteger('isactive')->default(0);
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
        Schema::dropIfExists('tbl_staticpage');
    }
}
