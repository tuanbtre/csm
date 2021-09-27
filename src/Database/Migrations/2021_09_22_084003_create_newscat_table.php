<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewscatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_cat', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->string('image', 255)->nullable();
			$table->string('re_name', 255);
			$table->tinyInteger('language_id')->default(2);
			$table->integer('priority')->default(1);
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
        Schema::dropIfExists('news_cat');
    }
}
