<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannertypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_type', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->string('group', 255)->nullable();
			$table->tinyInteger('type')->nullable()->default(2)->comment('1=>video, 2=>image');
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
        Schema::dropIfExists('banner_type');
    }
}
