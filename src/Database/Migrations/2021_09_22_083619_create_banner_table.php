<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_banner', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->string('pagecode', 255)->nullable();
			$table->string('youtube', 255)->nullable();
			$table->string('url', 255)->nullable();
			$table->text('brief', 255)->nullable();
			$table->string('image', 255)->nullable();
			$table->foreignId('cat_id')->constrained('banner_type')->onDelete('cascade');
			$table->tinyInteger('popup')->nullable()->default(0);
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
        Schema::dropIfExists('tbl_banner');
    }
}
