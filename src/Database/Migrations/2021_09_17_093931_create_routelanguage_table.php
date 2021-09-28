<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutelanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_language', function (Blueprint $table) {
            $table->id();
			$table->string('route_name', 255);
			$table->string('title', 255);
			$table->integer('parent_id')->default(0);
			$table->string('controlleract', 255)->nullable()->default(null);
			$table->string('url', 255)->nullable()->default(null);
			$table->string('middleware', 255)->nullable()->default(null);
			$table->string('method', 255);
			$table->tinyInteger('language_id');
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
        Schema::dropIfExists('route_language');
    }
}
