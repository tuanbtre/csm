<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->text('brief')->nullable();
			$table->string('url', 255)->nullable();
			$table->tinyInteger('new_tab')->nullable()->default(0);
			$table->string('image', 255)->nullable();
			$table->unsignedBigInteger('group')->nullable();
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
        Schema::dropIfExists('advertisement');
    }
}
