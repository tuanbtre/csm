<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_function', function (Blueprint $table) {
            $table->id();
			$table->string('icon', 255)->nullable()->default(null);
			$table->string('controlleract', 255)->nullable()->default(null);
			$table->string('url', 255)->nullable()->default(null);
			$table->string('method', 255);
			$table->string('title_en', 255);
			$table->string('title_vn', 255);
			$table->string('description', 255)->nullable()->default(null);
			$table->string('function_tab', 255);
			$table->string('route_name', 255)->nullable()->default(null);
			$table->tinyInteger('can_grant')->default(0);
			$table->tinyInteger('isshow')->default(0);
			$table->integer('parent_id')->default(0);
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
        Schema::dropIfExists('tbl_function');
    }
}
