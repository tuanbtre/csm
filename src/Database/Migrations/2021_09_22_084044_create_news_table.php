<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
			$table->foreignId('cat_id')->constrained('news_cat')->onDelete('cascade');
			$table->string('title', 255);
			$table->text('brief')->nullable();
			$table->longText('content')->nullable();
			$table->string('tag', 255)->nullable();
			$table->text('keyword')->nullable();
			$table->text('meta_description')->nullable();
			$table->string('image', 255)->nullable();
			$table->string('re_name', 255);
			$table->tinyInteger('ishot')->default(0);
			$table->tinyInteger('isdefault')->default(0);
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
        Schema::dropIfExists('news');
    }
}
