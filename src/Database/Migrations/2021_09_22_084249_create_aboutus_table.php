<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->text('brief')->nullable();
			$table->longText('content')->nullable();
			$table->text('keyword')->nullable();
			$table->text('meta_description')->nullable();
			$table->string('image', 255)->nullable();
			$table->string('re_name', 255);
			$table->tinyInteger('isdefault')->default(0);
			$table->integer('priority')->default(1);
			$table->tinyInteger('isactive')->default(0);
			$table->tinyInteger('language_id')->default(2);
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
        Schema::dropIfExists('about_us');
    }
}
